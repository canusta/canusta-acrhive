<?php
class Axial_CommandDispatcher{
        var $command;
        function Axial_CommandDispatcher($command){
	        $this->command = $command;
	    }

        function Dispatch(){
	
	        
	        
	        global $lang;
	        global $currentPage;
	        global $currentSubPage;
	        global $currentSubSubPage;
			$lang = $this->command->getCommandName();
			
			
			
			global $currentSubPage;
			$parameters = $this->command->getParameters();
			
			
			
			for($i = 0;$i<sizeof($parameters);$i++){
				$currentPage = $parameters[0];
				$currentSubPage = $parameters[1];
				$currentSubSubPage = $parameters[2];
			}
			
				
	
/* 			echo $lang; */
/* 			echo $currentPage; */
/* 			echo $currentSubPage; */
/* 			echo $currentSubSubPage; */
	
	
	
			if($currentPage==''){
				switch ($this->command->getCommandName())
	            {
	            case 'tr' : 
	                    include('root.php');
	                    break;
	            case 'eng' : 
	                    include('root.php');
	                    break;
	            }
			}else{
				
				
				
				switch ($currentPage)
	            {
	            case 'hakkinda' :
	            	 	include('menuPage.php');
	            		include('subMenuHakkinda.php');
	                    include('hakkinda.php');
	                    break;
	            case 'galeri' : 
	            		include('menuPage.php');
	            		include('subMenuGaleri.php');
	                    include('galeri.php');
	                    break;
	            case 'basin' : 
	            		include('menuPage.php');
	            		include('subMenuBasin.php');
	                    include('basin.php');
	                    break;
	            case 'iletisim' : 
	            		include('menuPage.php');
	            		include('subMenuIletisim.php');
	                    include('iletisim.php');
	                    break;
	            case 'noIntro' :
	                    include('root.php');
	                    break;
	            case 'newsletter-send' :
			            include('menuPage.php');
	                    include('newsletter-send.php');
	                    break;
	            }
	            
			}
			
			
	        
            
            if($currentSubPage!=''){
				switch ($currentSubPage)
	            {
	            case 'kavuklar-dan' : 
	                    include('hakkinda-kavuklar-dan.php');
	                    break;
	            case 'ege-hakkinda' : 
	                    include('hakkinda-ege-hakkinda.php');
	                    break;
	            case 'ege-mimari-konsept' : 
	                    include('hakkinda-ege-mimari-konsept.php');
	                    break;
	            case 'ege-de-yasam' : 
	                    include('hakkinda-ege-de-yasam.php');
	                    break;
	            case 'concierge' : 
	                    include('hakkinda-concierge.php');
	                    break;
	            case 'proje-ortaklarimiz' : 
	                    include('hakkinda-proje-ortaklarimiz.php');
	                    break;
	            case 'fotograflar' : 
	                    include('galeri-fotograflar.php');
	                    break;
	            case 'videolar' : 
	                    include('galeri-videolar.php');
	                    break;
	            case 'haberler' : 
	                    include('basin-haberler.php');
	                    break;
	            case 'kurumsal-kimlik' : 
	                    include('basin-kurumsal-kimlik.php');
	                    break;
	            case 'iletisim-adresleri' : 
	                    include('iletisim-iletisim-adresleri.php');
	                    break;
	            case 'iletisim-formu' : 
	                    include('iletisim-iletisim-formu.php');
	                    break;
	            case 'iletisim-formu-send' : 
	                    include('iletisim-iletisim-formu-send.php');
	                    break;
	            case 'google-maps' : 
	                    include('iletisim-google-maps.php');
	                    break;
	            }
			}
			
			
			/*
if($currentSubSubPage!='') }
				if($currentSubPage=='haberler'){
					include('haber.php')
				}
			}
*/
			
            
	  }
	  
	  
	  
}
        
        
        
?>