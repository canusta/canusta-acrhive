<?php
global $commandResult;
	$commandResult = '<b>Command:</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;'.$this->command->getCommandName().'<br/>';
			if (sizeof($this->command->getParameters()) > 0)
			{
				$commandResult .= '<b>Parameters:</b><br/>';
			}
			$parameters = $this->command->getParameters();
			for($i = 0;$i<sizeof($parameters);$i++)
				{
				
				$commandResult .= '&nbsp;&nbsp;&nbsp;&nbsp;'.$parameters[$i].'<br/>';
				
				}
		
?>