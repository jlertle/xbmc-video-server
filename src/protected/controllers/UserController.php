<?php

/**
 * Handles user accounts
 * 
 * @author Sam Stenvall <neggelandia@gmail.com>
 */
class UserController extends Controller
{

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			// TODO: Add access control
		);
	}

	/**
	 * Creates a new user
	 */
	public function actionCreate()
	{
		$model = new User();

		if (isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];

			if ($model->save())
			{
				Yii::app()->user->setFlash('success', 'Created user <em>'.$model->username.'</em>');

				$this->redirect(array('admin'));
			}
		}

		$this->render('create', array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a user
	 * @param int $id the user ID
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		if (isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];

			if ($model->save())
			{
				Yii::app()->user->setFlash('success', 'Updated user <em>'.$model->username.'</em>');

				$this->redirect(array('admin'));
			}
		}

		$this->render('update', array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a user
	 * @param int $id the user ID
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Manages all users
	 */
	public function actionAdmin()
	{
		$model = new User();
		$model->unsetAttributes();
		if (isset($_GET['User']))
			$model->attributes = $_GET['User'];

		$this->render('admin', array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param int $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = User::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

}