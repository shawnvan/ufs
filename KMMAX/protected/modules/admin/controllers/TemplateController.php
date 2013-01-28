<?php

class TemplateController extends TempletCommon
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		//获得标签
		$criteria=new CDbCriteria;
		$pages=new CPagination(Standardtask::model()->count($criteria));
		$pages->pageSize=Yii::app()->params['pagesize'];
   
		$pages->applyLimit($criteria);
		$sort=new CSort('Standardtask');
		$sort->attributes=array(
				'fTaskNo'=>array('asc'=>"fTaskNo",'desc'=>"fTaskNo desc",'label'=>Standardtask::model()->getAttributeLabel('fTaskNo')),
				'fTheme'=>array('asc'=>"fTheme",'desc'=>"fTheme desc",'label'=>Standardtask::model()->getAttributeLabel('fTheme')),
				'fCatalogueNo'=>array('asc'=>"fCatalogueNo",'desc'=>"fCatalogueNo desc",'label'=>Standardtask::model()->getAttributeLabel('fCatalogueNo')),
				'fAttachName'=>array('asc'=>"fAttachName",'desc'=>"fAttachName desc",'label'=>Standardtask::model()->getAttributeLabel('fAttachName')),
				'fSubmitUser'=>array('asc'=>"fSubmitUser",'desc'=>"fSubmitUser desc",'label'=>Standardtask::model()->getAttributeLabel('fSubmitUser')),
				'fSubmitDate'=>array('asc'=>"fSubmitDate",'desc'=>"fSubmitDate desc",'label'=>Standardtask::model()->getAttributeLabel('fSubmitDate')),
				'fConfirmUser'=>array('asc'=>"fConfirmUser",'desc'=>"fConfirmUser desc",'label'=>Standardtask::model()->getAttributeLabel('fConfirmUser')),
				'fConfirmDate'=>array('asc'=>"fConfirmDate",'desc'=>"fConfirmDate desc",'label'=>Standardtask::model()->getAttributeLabel('fConfirmDate')),
				'fTaskType'=>array('asc'=>"fTaskType",'desc'=>"fTaskType desc",'label'=>Standardtask::model()->getAttributeLabel('fTaskType')),
		);
		$sort->defaultOrder="fTaskNo";
		$gridRows=array();
		$template=Template::model()->findByPk($id);
		$template->fTemplateType=array_key_exists($template->fTemplateType,adminSettings::$TemplateType)?adminSettings::$TemplateType[$template->fTemplateType]:'';
		$template->fCreateDate=empty($template->fCreateDate)?'':date('Y-m-d',$template->fCreateDate);
		$template->fUpdateDate=empty($template->fUpdateDate)?'':date('Y-m-d',$template->fUpdateDate);
		$template->fStatus=$template->fStatus==0?Yii::t('label','IsNotActive'):Yii::t('label','IsActive');
		$this->render('view',array(
			'model'=>$template,
			'keyid'=>$id,'dataNode'=>$this->GetTempletCatalogue($id,'standtask'),'sort'=>$sort,'gridRows'=>$gridRows,'pages'=>$pages
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Template;
		if(isset($_POST['Template']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try {
				$model->attributes=$_POST['Template'];
				$model->fTemplateNo=GuidUtil::getUuid();
				$model->fCreate=Yii::app()->params->loginuser->fUserName;
				$model->fCreateDate=time();
				$model->fUpdate=Yii::app()->params->loginuser->fUserName;
				$model->fUpdateDate=time();
				$model->fStatus=1;
				$templates=Template::model()->findAll();
				foreach ($templates as $template){
					$template->fStatus=0;
					$template->save();
				}
				if($model->save()){
					$transaction->commit();
					$this->redirect(array('update','id'=>$model->fTemplateNo));
				}
				//提交事务会真正的执行数据库操作
			} catch (Exception $e) {
				$transaction->rollback(); //如果操作失败, 数据回滚
			}
			
			
		}
		$this->render('create',array(
			'model'=>$model,'fTemplateType'=>adminSettings::$TemplateType,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$criteria=new CDbCriteria;
		$pages=new CPagination(Standardtask::model()->count($criteria));
		$pages->pageSize=Yii::app()->params['pagesize'];
   
		$pages->applyLimit($criteria);
		$sort=new CSort('Standardtask');
		$sort->attributes=array(
				'fTaskNo'=>array('asc'=>"fTaskNo",'desc'=>"fTaskNo desc",'label'=>Standardtask::model()->getAttributeLabel('fTaskNo')),
				'fTheme'=>array('asc'=>"fTheme",'desc'=>"fTheme desc",'label'=>Standardtask::model()->getAttributeLabel('fTheme')),
				'fCatalogueNo'=>array('asc'=>"fCatalogueNo",'desc'=>"fCatalogueNo desc",'label'=>Standardtask::model()->getAttributeLabel('fCatalogueNo')),
				'fAttachName'=>array('asc'=>"fAttachName",'desc'=>"fAttachName desc",'label'=>Standardtask::model()->getAttributeLabel('fAttachName')),
				'fSubmitUser'=>array('asc'=>"fSubmitUser",'desc'=>"fSubmitUser desc",'label'=>Standardtask::model()->getAttributeLabel('fSubmitUser')),
				'fSubmitDate'=>array('asc'=>"fSubmitDate",'desc'=>"fSubmitDate desc",'label'=>Standardtask::model()->getAttributeLabel('fSubmitDate')),
				'fConfirmUser'=>array('asc'=>"fConfirmUser",'desc'=>"fConfirmUser desc",'label'=>Standardtask::model()->getAttributeLabel('fConfirmUser')),
				'fConfirmDate'=>array('asc'=>"fConfirmDate",'desc'=>"fConfirmDate desc",'label'=>Standardtask::model()->getAttributeLabel('fConfirmDate')),
				'fTaskType'=>array('asc'=>"fTaskType",'desc'=>"fTaskType desc",'label'=>Standardtask::model()->getAttributeLabel('fTaskType')),
		);
		$sort->defaultOrder="fTaskNo";
		$gridRows=array();
		$tempcatalogue=new Templatecatalogue;
		$this->render('Update',array(
			'model'=>$this->loadModel($id),'tempcatalogue'=>$tempcatalogue
				,'fWarnRate'=>adminSettings::$NodeWarnCycle,
			'keyid'=>$id,'dataNode'=>$this->GetTempletCatalogue($id,'standtask'),'sort'=>$sort,'gridRows'=>$gridRows,'pages'=>$pages
				,'fTemplateTypeRows'=>adminSettings::$TemplateType,'fIsActive'=>knowledgeSettings::$CatalogueStatus,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionCopy()
	{
		$templageNo=$_GET['id'];
		$CopyNewTemplageNo=GuidUtil::getUuid();
		$createtime=time();
		$dataNode = array();
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$templates=Template::model()->findAll();
			foreach ($templates as $template){
				$template->fStatus=0;
				$template->save();
			}
			//新增模板名称
			$sql="insert into tbl_template(fTemplateNo,fTemplateName,fTemplateType,fCreate,fCreateDate,fUpdate,fUpdateDate,fStatus,fUserGroup)
	                select '".$CopyNewTemplageNo."',concat('copy_',fTemplateName),fTemplateType,'".Yii::app()->params->loginuser->fUserName."',"
	                		.$createtime.',\''.Yii::app()->params->loginuser->fUserName.'\','.$createtime.",1,".$createtime." from tbl_template where fTemplateNo='".$templageNo."';";
			
			Yii::app()->db->createCommand($sql)->query();
			 //同步尽职调查目录结构
			$sql="insert into tbl_templatecatalogue(fCatalogueNo,fTemplateNo,fCatalogueName,fWarnStart,fWarnEnd,fWarnRate,fIsActive,fSort,fFatherCatalogueNo
					,fUserGroup,fCreateDate,fCreateUser,fUpdateDate,fUpdateUser)
					select fCatalogueNo,'".$CopyNewTemplageNo."',fCatalogueName,fWarnStart,fWarnEnd,fWarnRate,fIsActive,fSort,
					fFatherCatalogueNo,fUserGroup,".$createtime.",fCreateUser,
					".$createtime.",fUpdateUser from tbl_templatecatalogue where fTemplateNo='".$templageNo."';";
			
			  Yii::app()->db->createCommand($sql)->query();
		  
			  //同步标准任务
			  $templatestasks=Templetstandardtask::model()->findAllByAttributes(array('fTemplateNo'=>$templageNo));
			  foreach ($templatestasks as $task){
			  	$newtask=new Templetstandardtask();
			  	$newtask->fCatalogueNo=$task->fCatalogueNo;
			    $newtask->fTaskNo=$task->fTaskNo;
			  	$newtask->fTemplateNo=$CopyNewTemplageNo;
			  	$newtask->save();
			  }
		  
		  /*项目保存*/
		  $transaction->commit();
		//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
		//获得新添加的尽职调查目录结构
		$models=Templatecatalogue::model()->findAll('fTemplateNo=:fTemplateNo or fTemplateNo=\'\'',array(':fTemplateNo'=>$CopyNewTemplageNo));
		foreach ($models as $key=>$model){
			$dataNode[]=array(
					'id'=>CHtml::encode($model->fCatalogueNo),
					'name'=>CHtml::encode($model->fCatalogueName),
					'pId'=>CHtml::encode($model->fFatherCatalogueNo)
			);
		};
		$modeltemplete=Template::model()->findByPk($CopyNewTemplageNo);
		$dataNode = json_encode($dataNode);
		//获得标签
		$criteria=new CDbCriteria;
		$pages=new CPagination(Standardtask::model()->count($criteria));
		$pages->pageSize=Yii::app()->params['pagesize'];
		$pages->applyLimit($criteria);
		$sort=new CSort('Standardtask');
		$sort->attributes=array(
				'fTaskNo'=>array('asc'=>"fTaskNo",'desc'=>"fTaskNo desc",'label'=>Standardtask::model()->getAttributeLabel('fTaskNo')),
				'fTheme'=>array('asc'=>"fTheme",'desc'=>"fTheme desc",'label'=>Standardtask::model()->getAttributeLabel('fTheme')),
				'fCatalogueNo'=>array('asc'=>"fCatalogueNo",'desc'=>"fCatalogueNo desc",'label'=>Standardtask::model()->getAttributeLabel('fCatalogueNo')),
				'fAttachName'=>array('asc'=>"fAttachName",'desc'=>"fAttachName desc",'label'=>Standardtask::model()->getAttributeLabel('fAttachName')),
				'fSubmitUser'=>array('asc'=>"fSubmitUser",'desc'=>"fSubmitUser desc",'label'=>Standardtask::model()->getAttributeLabel('fSubmitUser')),
				'fSubmitDate'=>array('asc'=>"fSubmitDate",'desc'=>"fSubmitDate desc",'label'=>Standardtask::model()->getAttributeLabel('fSubmitDate')),
				'fConfirmUser'=>array('asc'=>"fConfirmUser",'desc'=>"fConfirmUser desc",'label'=>Standardtask::model()->getAttributeLabel('fConfirmUser')),
				'fConfirmDate'=>array('asc'=>"fConfirmDate",'desc'=>"fConfirmDate desc",'label'=>Standardtask::model()->getAttributeLabel('fConfirmDate')),
				'fTaskType'=>array('asc'=>"fTaskType",'desc'=>"fTaskType desc",'label'=>Standardtask::model()->getAttributeLabel('fTaskType')),
		);
		$gridRows=array();
		$tempcatalogue=new Templatecatalogue;
		$this->render('update',array(
			'model'=>$this->loadModel($CopyNewTemplageNo),'tempcatalogue'=>$tempcatalogue,'fWarnRate'=>adminSettings::$NodeWarnCycle,
			'keyid'=>$CopyNewTemplageNo,'dataNode'=>$dataNode,'sort'=>$sort,'gridRows'=>$gridRows,'pages'=>$pages,'fTemplateTypeRows'=>adminSettings::$TemplateType,'fIsActive'=>knowledgeSettings::$CatalogueStatus,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	/**
	 * 删除模板
	 * If creation is successful, the browser will be redirected to the 'grid' page.
	 */
	public function actionDeletetemp()
	{
		//验证模板是否已经有项目使用
		$criteria=new CDbCriteria;
		$criteria->addCondition("fTemplateNo = :fTemplateNo");
		$criteria->params[':fTemplateNo']=$_GET['id'];
		if(Item::model()->count($criteria)>0) {print_r('有项目在使用，不可删除');return;}//记录总数
		$transaction = Yii::app()->db->beginTransaction();
		try {
			//删除标准任务
			Templetstandardtask::model()->deleteAll($criteria);
			//删除分类
			Templatecatalogue::model()->deleteAll($criteria);
			//删除模板
			Template::model()->deleteAll($criteria);
			//启用最新的一个模板
			$criteria = new CDbCriteria;
			$criteria->order = 'fUpdateDate DESC' ;
			$criteria->limit =1;
			$temp=Template::model()->find($criteria);
			$temp->fStatus=1;
			$temp->save();
			$transaction->commit();
			//提交事务会真正的执行数据库操作
		} catch (Exception $e) {
			$transaction->rollback(); //如果操作失败, 数据回滚
		}
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Template();
		$model->TestSearch();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Template'])){
			$model->attributes=$_GET['Template'];
			$model->fCreateDateBeginDate =$_GET['Template']['fCreateDateBeginDate'];
			$model->fCreateDateEndDate =$_GET['Template']['fCreateDateEndDate'];
			$model->fUpdateDateBeginDate =$_GET['Template']['fUpdateDateBeginDate'];
			$model->fUpdateDateEndDate =$_GET['Template']['fUpdateDateEndDate'];
		}	
		$this->render('admin',array(
			'model'=>$model,'fTemplateType'=>adminSettings::$TemplateType
		));
	}

	/**
     * Grid of all models.
     */
    public function actionIndex()
    {
		$criteria=new CDbCriteria;
		$mol=new Template();
		if(isset($_GET['Template'])){
			$mol->attributes=$_GET['Template'];
			$mol->fCreateDateBeginDate =$_GET['Template']['fCreateDateBeginDate'];
			$mol->fCreateDateEndDate =$_GET['Template']['fCreateDateEndDate'];
			$mol->fUpdateDateBeginDate =$_GET['Template']['fUpdateDateBeginDate'];
			$mol->fUpdateDateEndDate =$_GET['Template']['fUpdateDateEndDate'];
		}
        $pages=new CPagination(Template::model()->count($criteria));//记录总数
        $pages->pageSize=Yii::app()->params['pagesize'];//设置每页的记录显示条数
        $pages->applyLimit($criteria);
        $sort=new CSort('Template');//排序，参考YII文档CSort
        $sort->attributes=array(
        'fTemplateNo'=>array('asc'=>'fTemplateNo','desc'=>'fTemplateNo desc','label'=>Template::model()->getAttributeLabel('fTemplateNo')),
		'fTemplateName'=>array('asc'=>'fTemplateName','desc'=>'fTemplateName desc','label'=>Template::model()->getAttributeLabel('fTemplateName')),
		'fTemplateType'=>array('asc'=>'fTemplateType','desc'=>'fTemplateType desc','label'=>Template::model()->getAttributeLabel('fTemplateType')),
		'fCreate'=>array('asc'=>'fCreate','desc'=>'fCreate desc','label'=>Template::model()->getAttributeLabel('fCreate')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Template::model()->getAttributeLabel('fCreateDate')),
		'fUpdate'=>array('asc'=>'fUpdate','desc'=>'fUpdate desc','label'=>Template::model()->getAttributeLabel('fUpdate')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Template::model()->getAttributeLabel('fUpdateDate')),
		'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>Template::model()->getAttributeLabel('fStatus')),
		'fUserGroup'=>array('asc'=>'fUserGroup','desc'=>'fUserGroup desc','label'=>Template::model()->getAttributeLabel('fUserGroup')),
        );
        $sort->defaultOrder='fTemplateNo';
        $sort->applyOrder($criteria);
        $models=Template::model()->findAll($criteria);
        $gridRows=array();
        $this->render('index',array(
            'models'=>$models,
            'pages'=>$pages,
            'sort'=>$sort,
            'gridRows'=>$gridRows,
            'model'=>$mol,'fTemplateType'=>adminSettings::$TemplateType
        ));
    }


    /**
     * Print out array of models for the jqGrid rows.
     */
    public function actionGridData()
    {  	
        if(!Yii::app()->request->isPostRequest)
        {
            throw new CHttpException(400,Yii::t('http','Invalid request. Please do not repeat this request again.'));
            exit;
        } 
        $jqGrid=$this->processJqGridRequest();
        $criteria=new CDbCriteria;
        $criteria->addCondition('1=1 ');
        $mol=new Template();
        if(isset($_GET['Template'])){
        	$mol->attributes=$_GET['Template'];
			$mol->fCreateDateBeginDate =$_GET['Template']['fCreateDateBeginDate'];
			$mol->fCreateDateEndDate =$_GET['Template']['fCreateDateEndDate'];
			$mol->fUpdateDateBeginDate =$_GET['Template']['fUpdateDateBeginDate'];
			$mol->fUpdateDateEndDate =$_GET['Template']['fUpdateDateEndDate'];
        }
        $criteria=$mol->AdvancedSearch();		
        if($jqGrid['filters']!=null){
            $filters=json_decode($jqGrid['filters']);
        	if(!empty($filters->groupOp) && (!empty($filters->rules))){
        		$operation=$this->getJqGridOperationArray();
        		$keywordFormula=$this->getJqGridKeywordFormulaArray();
        		$condition='';
        		$param=array();
        		foreach($filters->rules as $temp){
        			if(empty($condition))
        				$condition=' t.'.$temp->field.' '.$operation[$temp->op].' :'.$temp->field;
        			else
        				$condition=$condition.' '.$filters->groupOp.' t.'.$temp->field.' '.$operation[$temp->op].' :'.$temp->field;
        			$param[':'.$temp->field]=str_replace('keyword',$temp->data,$keywordFormula[$temp->op]);
        		}
        		$criteria->condition=$condition;
        		$criteria->params=$param;
        	}
        }
		// pagination
		$pages=new CPagination(Template::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : Yii::app()->params['pagesize'];
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('Template');		
        $sort->attributes=array(
           		'fTemplateNo'=>array('asc'=>'fTemplateNo','desc'=>'fTemplateNo desc','label'=>Template::model()->getAttributeLabel('fTemplateNo')),
		'fTemplateName'=>array('asc'=>'fTemplateName','desc'=>'fTemplateName desc','label'=>Template::model()->getAttributeLabel('fTemplateName')),
		'fTemplateType'=>array('asc'=>'fTemplateType','desc'=>'fTemplateType desc','label'=>Template::model()->getAttributeLabel('fTemplateType')),
		'fCreate'=>array('asc'=>'fCreate','desc'=>'fCreate desc','label'=>Template::model()->getAttributeLabel('fCreate')),
		'fCreateDate'=>array('asc'=>'fCreateDate','desc'=>'fCreateDate desc','label'=>Template::model()->getAttributeLabel('fCreateDate')),
		'fUpdate'=>array('asc'=>'fUpdate','desc'=>'fUpdate desc','label'=>Template::model()->getAttributeLabel('fUpdate')),
		'fUpdateDate'=>array('asc'=>'fUpdateDate','desc'=>'fUpdateDate desc','label'=>Template::model()->getAttributeLabel('fUpdateDate')),
		'fStatus'=>array('asc'=>'fStatus','desc'=>'fStatus desc','label'=>Template::model()->getAttributeLabel('fStatus')),
        );
        $sort->defaultOrder='fUpdateDate desc';
        $sort->applyOrder($criteria);
        // find all
        $models=Template::model()->findAll($criteria);       
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {
            $data['rows'][]=array(
                		 'fTemplateNo'=>$model->fTemplateNo,
						'cell'=>array(CHtml::encode($model->fTemplateNo),
			 CHtml::encode($model->fTemplateName).(Yii::app()->user->checkAccess('admin.template.Update')?CHtml::link("<span class='ui-row ui-row-edit'></span>",array('update','id'=>$model->fTemplateNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>Yii::t('label','Update')
                )):'').(Yii::app()->user->checkAccess('admin.template.View')?CHtml::link("<span class='ui-row ui-row-view'></span>",array('view','id'=>$model->fTemplateNo),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>Yii::t('label','View')
                )):'').(Yii::app()->user->checkAccess('admin.template.Delete')?CHtml::link("<span class='ui-row ui-row-delete'></span>",array('delete','id'=>$model->fTemplateNo),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button UFSGrid-row-delete',
					'align'=>'right',
                	'rel'=>$model->fTemplateNo,
                    'title'=>Yii::t('label','Delete')
                )):''),
		 CHtml::encode(array_key_exists($model->fTemplateType,adminSettings::$TemplateType)?adminSettings::$TemplateType[$model->fTemplateType]:''),
		 CHtml::encode($model->fCreate),
		 CHtml::encode(empty($model->fCreateDate)?'':(date('Y-m-d',$model->fCreateDate))),
		 CHtml::encode($model->fUpdate),
		 CHtml::encode(empty($model->fUpdateDate)?'':(date('Y-m-d',$model->fUpdateDate))),
		 CHtml::encode($model->fStatus==0?Yii::t('label','IsNotActive'):Yii::t('label','IsActive')),
            ));
        }
        UFSBaseUtil::printJson($data);
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Template::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='template-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	/**
	 * 模板保存
	 */
	public function actionUpdatename(){
		if(isset($_POST['id'])&&isset($_POST['name']))
		$templete=Template::model()->findByPk($_POST['id']);
		$templete->fTemplateName=isset($_POST['name'])?$_POST['name']:'';
		$templete->fTemplateType=isset($_POST['type'])?$_POST['type']:'';
		$templete->fUpdate=Yii::app()->params->loginuser->fUserName;
		$templete->fUpdateDate=time();
		$templete->save();
		echo $this->FrameInfo(Yii::app()->params['layouttype']['top'],Yii::t('message','Index Success'),Yii::app()->params['notytype']['success']);
	}
}
