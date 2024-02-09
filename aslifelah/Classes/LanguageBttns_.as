/*
* @author Can Usta
*/

package 
{
	
	import canusta.data.*;
	import flash.display.*;
	import lt.uza.utils.*;
	import flash.events.*;
	import XMLList;
	import lt.uza.utils.*
	import caurina.transitions.*;;
	
	public class LanguageBttns extends MovieClip
	{
		
		private var global							: Global = Global.getInstance();
		private var db								: XML = global.db;
		private var languagebttns					: Array;
		public var selectedlanguage					: String = 'eng';
		
		public function LanguageBttns():void
		{
			
			global.root.resizewarning.push(this);
			global.selectedlanguage = selectedlanguage;
			run();
			
		}
		
		public	function run():void {
			
			addlanguagebuttons();
			
		}
		
		private function addlanguagebuttons():void {
			
			var languages : Array = new Array();
			languages = [	new Array('eng', 'English', true),
							new Array('tr', 'Türkçe', true),
							new Array('it', 'Italiano', true)
						]
			
			languagebttns = new Array()
			
			for(var i : Number = 0; i < 3; i++)
			{
				if ( global.selectedlanguage != languages[i][0] )
				{
					
					var languagebutton : LanguageButton = new LanguageButton(languages[i][0],languages[i][1]);
					addChild(languagebutton);
					languagebttns.push(languagebutton);
					
				}
			}
			
			languagebttns[0].x = 50;
			languagebttns[1].x = Math.round(languagebttns[0].width) + 50 + 1;
			languagebttns[0].y = global.sh;
			languagebttns[1].y = global.sh;
			
			LocateLanguageButtons(true);
			
		}
		
		private function LocateLanguageButtons(ease:Boolean=false):void {
			
			if(ease==false){
				languagebttns[0].x = 50;
				languagebttns[1].x = Math.round(languagebttns[0].width) + 50 + 1;
				languagebttns[0].y = Math.round(global.sh) - 28 - 50;
				languagebttns[1].y = Math.round(global.sh) - 28 - 50;		
			}else{
				Tweener.addTween(languagebttns[0], { x: 50, time:0.5, transition:"easeOutExpo"} );
				Tweener.addTween(languagebttns[1], { x: Math.round(languagebttns[0].width) + 50 + 1, time:0.5, transition:"easeOutExpo"} );
				Tweener.addTween(languagebttns[0], { y: Math.round(global.sh) - 28 - 50, time:0.5, transition:"easeOutExpo"} );
				Tweener.addTween(languagebttns[1], { y: Math.round(global.sh) - 28 - 50, time:2, transition:"easeOutExpo"} );
			}
			
		}
		
		public function StageResized(e:Event=null):void
		{
			LocateLanguageButtons(true);
		}
		
	}
	
}