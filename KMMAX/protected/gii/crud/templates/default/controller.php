<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass."\n"; ?>
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'keyid'=>$id
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$model=new <?php echo $this->modelClass; ?>;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($model->save())
				$this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($model->save())
				$this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
		}

		$this->render('update',array(
			'model'=>$model,
			'keyid'=>$id
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionCopy()
	{


		$id=$_GET['id'];
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$createmodel=new <?php echo $this->modelClass; ?>;
			$createmodel->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($createmodel->save())
				$this->redirect(array('view','id'=>$createmodel-><?php echo $this->tableSchema->primaryKey; ?>));
		}

		$this->render('copy',array(
			'model'=>$model,
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new <?php echo $this->modelClass; ?>('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['<?php echo $this->modelClass; ?>']))
			$model->attributes=$_GET['<?php echo $this->modelClass; ?>'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
     * Grid of all models.
     */
    public function actionIndex()
    {
		$criteria=new CDbCriteria;

        $pages=new CPagination(<?php echo $this->modelClass; ?>::model()->count($criteria));//记录总数
        $pages->pageSize=5;//设置每页的记录显示条数
        $pages->applyLimit($criteria);
		
        $sort=new CSort('<?php echo $this->modelClass; ?>');//排序，参考YII文档CSort
        $sort->attributes=array(
        	<?php
			$count=0;
			foreach($this->tableSchema->columns as $column)
			{
				if(++$count==7)
					echo "\t\t/*\n";
				echo "\t\t'".$column->name."'=>array('asc'=>'".$column->name."','desc'=>'".$column->name." desc','label'=>".$this->modelClass."::model()->getAttributeLabel('".$column->name."')),\n";
			}
			if($count>=7)
				echo "\t\t*/'".$column->name."'=>array('asc'=>'".$column->name."','desc'=>'".$column->name." desc','label'=>".$this->modelClass."::model()->getAttributeLabel('".$column->name."')),\n";
			?>
        );
        $sort->defaultOrder='<?php echo $this->tableSchema->primaryKey;?>';
        $sort->applyOrder($criteria);

        // find all
        $models=<?php echo $this->modelClass; ?>::model()->findAll($criteria);

        // rows for the static grid
        $gridRows=array();
        foreach($models as $model)
        {
            $gridRows[]=array(
            	<?php
				$count=0;
				foreach($this->tableSchema->columns as $column)
				{
					if(++$count==7)
						echo "\t\t/*\n";
						echo "\t\t array('content'=>CHtml::encode(\$model->".$column->name.")),\n";
				}
				if($count>=7)
					echo "\t\t*/\n";
				?>
            );
        }	
		
		$model=new <?php echo $this->modelClass; ?>;
		$model->unsetAttributes();  // clear any default values

        // render the view file
        $this->render('index',array(
            'models'=>$models,
            'pages'=>$pages,
            'sort'=>$sort,
            'gridRows'=>$gridRows,
            'model'=>$model,
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
        // specify request details
        $jqGrid=$this->processJqGridRequest();
        $criteria=new CDbCriteria;

		if(isset($_GET['type'])){
			//用户所有未作输入的字段（类型checkbox不处理）设置为NULL
			if(trim($_GET['fUser'])==''){$_GET['fUser'] =NULL;}
			if(trim($_GET['fUserName'])==''){$_GET['fUserName'] =NULL;}
			//添加搜索条件
			$criteria->addCondition('(fUser=:fUser OR :fUser IS NULL)');
			$criteria->addCondition('(fUserName=:fUserName OR :fUserName IS NULL)');
			$criteria->addCondition('fIsActive=:fIsActive');
			//为搜索字段赋值
			$criteria->params =array(
							':fUser'=>$_GET['fUser'],
							':fUserName'=>$_GET['fUserName'],
							':fIsActive'=>$_GET['fIsActive'],
							);
							
		}

        if($jqGrid['searchField']!==null && $jqGrid['searchString']!==null && $jqGrid['searchOper']!==null)
        {
            $field=array(
				<?php
				$count=0;
				foreach($this->tableSchema->columns as $column)
				{
					if(++$count==7)
						echo "\t\t/*\n";
					echo "\t\t'".$column->name."'=>".$this->modelClass."::model()->getAttributeLabel('".$column->name."'),\n";
				}
				if($count>=7)
					echo "\t\t*/'".$column->name."'=>array('asc'=>'".$column->name."','desc'=>'".$column->name." desc','label'=>".$this->modelClass."::model()->getAttributeLabel('".$column->name."')),\n";
				?>
            );
			
            $operation=$this->getJqGridOperationArray();
			
            $keywordFormula=$this->getJqGridKeywordFormulaArray();
			
            if(isset($field[$jqGrid['searchField']]) && isset($operation[$jqGrid['searchOper']]))
            {
                $criteria->condition='('.$field[$jqGrid['searchField']].' '.$operation[$jqGrid['searchOper']].' :keyword)';
                $criteria->params=array(':keyword'=>str_replace('keyword',$jqGrid['searchString'],$keywordFormula[$jqGrid['searchOper']]));
                // search by special field types
                if($jqGrid['searchField']==='createTime' && ($keyword=strtotime($jqGrid['searchString']))!==false)
                {
                    $criteria->params=array(':keyword'=>str_replace('keyword',$keyword,$keywordFormula[$jqGrid['searchOper']]));
                    if(date('H:i:s',$keyword)==='00:00:00')
                        // visitor is looking for a precision by day, not by second
                        $criteria->condition='(TO_DAYS(FROM_UNIXTIME('.$field[$jqGrid['searchField']].',"%Y-%m-%d")) '.$operation[$jqGrid['searchOper']].' TO_DAYS(FROM_UNIXTIME(:keyword,"%Y-%m-%d")))';
                }
            }
        }

		// pagination
        
		$pages=new CPagination(<?php echo $this->modelClass; ?>::model()->count($criteria));
        $pages->pageSize=$jqGrid['pageSize']!==null ? $jqGrid['pageSize'] : 5;
        $pages->applyLimit($criteria);
        // sort
        $sort=new CSort('<?php echo $this->modelClass; ?>');
		
        $sort->attributes=array(
           <?php
			$count=0;
			foreach($this->tableSchema->columns as $column)
			{
				if(++$count==7)
					echo "\t\t/*\n";
				echo "\t\t'".$column->name."'=>array('asc'=>'".$column->name."','desc'=>'".$column->name." desc','label'=>".$this->modelClass."::model()->getAttributeLabel('".$column->name."')),\n";
			}
			if($count>=7)
				echo "\t\t*/'".$column->name."'=>array('asc'=>'".$column->name."','desc'=>'".$column->name." desc','label'=>".$this->modelClass."::model()->getAttributeLabel('".$column->name."')),\n";
			?>
        );
        $sort->defaultOrder='<?php echo $this->tableSchema->primaryKey;?>';
        $sort->applyOrder($criteria);

        // find all
        $models=<?php echo $this->modelClass; ?>::model()->findAll($criteria);
        $data=array(
            'page'=>$pages->getCurrentPage()+1,
            'total'=>$pages->getPageCount(),
            'records'=>$pages->getItemCount(),
            'rows'=>array()
        );
        foreach($models as $model)
        {

            $data['rows'][]=array(
                <?php
				$primaryKey = $this->tableSchema->primaryKey;
				$ModuleID = $this->ModuleID;
				$ControllerID = $this->ControllerID;
				$access=$ModuleID.'.'.$ControllerID;
				foreach($this->tableSchema->columns as $column)
				{
					$actionsView="CHtml::link(\""."<span class='ui-icon ui-icon-zoomin'></span>"."\",array('view','id'=>\$model->$primaryKey),array(
                    'class'=>'UFSGrid-show UFSGrid-row-button',
                    'align'=>'right',
					'title'=>'view'
                ))";
					$actionsUpdate= "CHtml::link(\""."<span class='ui-icon ui-icon-pencil'></span>"."\",array('update','id'=>\$model->$primaryKey),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'update'
                ))";
					$actionsDel= "CHtml::link(\""."<span class='ui-icon ui-icon-pencil'></span>"."\",array('delete','id'=>\$model->$primaryKey),array(
                    'class'=>'UFSGrid-edit UFSGrid-row-button',
					'align'=>'right',
                    'title'=>'delete'
                ))";
					if ($column->name==$primaryKey){
						echo "\t\t '$primaryKey'=>\$model->$primaryKey,
						'cell'=>array(CHtml::encode(\$model->$primaryKey).(Yii::app()->user->checkAccess('".$access.".Update')?".$actionsUpdate.":'').(Yii::app()->user->checkAccess('".$access .".View')?".$actionsView.":'').(Yii::app()->user->checkAccess('".$access .".Delete')?".$actionsDel.":''),";						
					}else{
						echo "\t\t CHtml::encode(\$model->".$column->name."),\n";
					}
				}

				?>
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
		$model=<?php echo $this->modelClass; ?>::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='<?php echo $this->class2id($this->modelClass); ?>-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
