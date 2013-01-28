<?php
interface ITaskHistory {
	function CanShip(Task $task);
	function Ship(Task $task);	
	function CanCancel(Task $task);
	function Cancel(Task $task);
}
?>