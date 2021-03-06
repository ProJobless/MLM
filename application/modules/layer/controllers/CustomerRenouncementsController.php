<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class Layer_CustomerRenouncementsController extends Zend_Controller_Action
{
	public function addAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->create("Renouncement");
		$form = new Customers_RenouncementForm($model);
		$this->getHelper("FormAction")->simpleAction($form, $model);
		$this->view->form = $form;
	}

	public function setModel(Zend_Form $form, \Model\Renouncement $model)
	{
		$em = EntityManager::getInstance();
		$values = $form->getValue("basic");
		$model->documentSendDate = $values['document_send_date'];
		$model->policyCreateDate = $values['policy_create_date'];
		$model->policyNumber = $values['policy_number'];

		$model->customer = $em->find("Customer", $form->getValue("parent"));
	}

	public function editAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("Renouncement", $this->_getParam("id"));
		$form = new Customers_RenouncementForm($model);
		$this->getHelper("FormAction")->simpleAction($form, $model);
		$this->view->form = $form;
	}

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("Renouncement", $this->_getParam("id"));
		$em->delete($model);
		$this->getHelper("formAction")->simpleEndAction();
	}
}

