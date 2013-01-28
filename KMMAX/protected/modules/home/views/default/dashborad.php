<div class="content">
	<script type="text/javascript"
		src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/jqbargraph/jqBarGraph.js"></script>  
<?php
$this->breadcrumbs = array(
    'Nav'
);

Yii::app()->clientScript->registerScript('gethiddenpkey', "");
?>

<div class="ui-widget ui-helper-clearfix">
		<div id="order">
			<ul id="order-block"
				class="gallery ui-helper-reset ui-helper-clearfix">
    <?php
    $model = array(
        array(
            'fSellerOrderCode' => '加入项目',
            'fConsigneeCode' => '0',
            'fConsigneeAddress1' => '0',
            'fConsigneeContact' => '0'
        ),
        array(
            'fSellerOrderCode' => '紧急处理',
            'fConsigneeCode' => '2',
            'fConsigneeAddress1' => '3',
            'fConsigneeContact' => '4'
        ),
        array(
            'fSellerOrderCode' => '项目任务',
            'fConsigneeCode' => '2',
            'fConsigneeAddress1' => '3',
            'fConsigneeContact' => '4'
        ),
        array(
            'fSellerOrderCode' => '项目成果',
            'fConsigneeCode' => '2',
            'fConsigneeAddress1' => '3',
            'fConsigneeContact' => '4'
        ),
        array(
            'fSellerOrderCode' => '项目文档',
            'fConsigneeCode' => '2',
            'fConsigneeAddress1' => '3',
            'fConsigneeContact' => '4'
        ),
        array(
            'fSellerOrderCode' => '消息中心',
            'fConsigneeCode' => '2',
            'fConsigneeAddress1' => '3',
            'fConsigneeContact' => '4'
        ),
        array(
            'fSellerOrderCode' => '知识库',
            'fConsigneeCode' => '2',
            'fConsigneeAddress1' => '3',
            'fConsigneeContact' => '4'
        ),
        array(
            'fSellerOrderCode' => '7',
            'fConsigneeCode' => '2',
            'fConsigneeAddress1' => '3',
            'fConsigneeContact' => '4'
        ),
        array(
            'fSellerOrderCode' => '7',
            'fConsigneeCode' => '2',
            'fConsigneeAddress1' => '3',
            'fConsigneeContact' => '4'
        )
    );
    foreach ($model as $k => $row) {
        ?>
		<li class="ui-widget-content ui-corner-tr"
					id="recordsArray_<?php echo $row['fSellerOrderCode'];?>">
					<h5 class="ui-widget-header"><?php echo $row['fSellerOrderCode'];?></h5>
					<div style="width: 96px; height: 72px;">
						<p><?php echo $row['fConsigneeCode'];?><a
								href="images/high_tatras.jpg" title="View larger image"
								class="ui-icon ui-icon-zoomin">View larger</a>
						</p>
						<p><?php echo $row['fConsigneeAddress1'];?> <a
								href="link/to/trash/script/when/we/have/js/off"
								title="Delete this image" class="ui-icon ui-icon-trash">Delete
								image</a>
						</p>
						<p><?php echo $row['fConsigneeContact'];?></p>
					</div>
				</li>	
		<?php }; ?>
</ul>
		</div>
	</div>
	<style>
#order {
	width: 90%;
	display: inline-block;
	float: left;
	margin: 0px 10px;
}

#order h4 {
	background: #aaa;
	width: 105.5%;
	height: 30px;
	text-align: center;
	line-height: 30px;
	font-size: 20px;
	font-weight: bold;
}

#order-block {
	border: 1px solid white;
	background: #D1D1D1;
	padding: 1em 1.4em;
	width: 99%;
	min-height: 12em;
}

* html #order-block {
	height: 12em;
} /* IE6 */
.gallery.custom-state-active {
	background: #eee;
}

.gallery li {
	float: left;
	width: 400px;
	height: 280px;
	padding: 0.4em;
	margin: 15px 0.4em 0.4em 0;
	text-align: center;
}

.gallery li h5 {
	margin: 0 0 0.4em;
	cursor: move;
}

.gallery li a {
	float: right;
}

.gallery li a.ui-icon-zoomin {
	float: left;
}

.gallery li img {
	width: 100%;
	cursor: move;
}

#truck {
	float: right;
	width: 62%;
}

* html #truck-block {
	height: 18em;
} /* IE6 */
#truck-block {
	float: right;
	width: 99%;
	min-height: 18em;
	padding: 1%;
}

* html #truck-block {
	height: 18em;
} /* IE6 */
#truck-form {
	float: right;
	width: 99%;
	min-height: 18em;
	padding: 1%;
}

* html #truck-block {
	height: 18em;
} /* IE6 */
#truck-block h4 .ui-icon {
	float: left;
}
</style>

</div>
<script>
    $(function() {
        // there's the gallery and the trash
        var $gallery = $( "#order-block" ),
            $trash = $( "#truck-block" );
 
        // let the gallery items be draggable
        $( "li", $gallery ).draggable({
            cancel: "a.ui-icon", // clicking an icon won't initiate dragging
            revert: "invalid", // when not dropped, the item will revert back to its initial position
            containment: "document",
            helper: "clone",
            cursor: "move"
        });
 
        // let the trash be droppable, accepting the gallery items
        $trash.droppable({
            accept: "#order-block > li",
            activeClass: "ui-state-highlight",
            drop: function( event, ui ) {
                deleteImage( ui.draggable );
            }
        });
 
        // let the gallery be droppable as well, accepting items from the trash
        $gallery.droppable({
            accept: "#truck-block li",
            activeClass: "custom-state-active",
            drop: function( event, ui ) {
                recycleImage( ui.draggable );
            }
        });
 
        // image deletion function
        var recycle_icon = "<a href='link/to/recycle/script/when/we/have/js/off' title='Recycle this image' class='ui-icon ui-icon-refresh'>Recycle image</a>";
        function deleteImage( $item ) {
            $item.fadeOut(function() {
                var $list = $( "ul", $trash ).length ?
                    $( "ul", $trash ) :
                    $( "<ul class='gallery ui-helper-reset'/>" ).appendTo( $trash );
 
                $item.find( "a.ui-icon-trash" ).remove();
                $item.append( recycle_icon ).appendTo( $list ).fadeIn(function() {
                    $item
                        .animate({ width: "96px" })
                        .find( "img" )
                            .animate({ height: "120px" });
                });
            });
        }
 
        // image recycle function
        var trash_icon = "<a href='link/to/trash/script/when/we/have/js/off' title='Delete this image' class='ui-icon ui-icon-trash'>Delete image</a>";
        function recycleImage( $item ) {
            $item.fadeOut(function() {
                $item
                    .find( "a.ui-icon-refresh" )
                        .remove()
                    .end()
                    .css( "width", "96px")
                    .append( trash_icon )
                    .find( "img" )
                        .css( "height", "72px" )
                    .end()
                    .appendTo( $gallery )
                    .fadeIn();
            });
        }
 
        // image preview function, demonstrating the ui.dialog used as a modal window
        function viewLargerImage( $link ) {
            var src = $link.attr( "href" ),
                title = $link.siblings( "img" ).attr( "alt" ),
                $modal = $( "img[src$='" + src + "']" );
 
            if ( $modal.length ) {
                $modal.dialog( "open" );
            } else {
                var img = $( "<img alt='" + title + "' width='384' height='288' style='display: none; padding: 8px;' />" )
                    .attr( "src", src ).appendTo( "body" );
                setTimeout(function() {
                    img.dialog({
                        title: title,
                        width: 400,
                        modal: true
                    });
                }, 1 );
            }
        }
 
        // resolve the icons behavior with event delegation
        $( "ul.gallery > li" ).click(function( event ) {
            var $item = $( this ),
                $target = $( event.target );
 
            if ( $target.is( "a.ui-icon-trash" ) ) {
                deleteImage( $item );
            } else if ( $target.is( "a.ui-icon-zoomin" ) ) {
                viewLargerImage( $target );
            } else if ( $target.is( "a.ui-icon-refresh" ) ) {
                recycleImage( $item );
            }
 
            return false;
        });
    });
    </script>