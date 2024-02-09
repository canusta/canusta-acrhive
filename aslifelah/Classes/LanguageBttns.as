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
		private var db								: Object = global.db.staticnames.language.*;
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
			
			var bttnlabel1 : String = db[0];
			var bttnurl1 : String = db[0].@url;
			var bttnlabel2 : String = db[1];
			var bttnurl2 : String = db[1].@url;
			
			languagebttns = new Array()
			
			var languagebutton : LanguageButton = new LanguageButton(bttnurl1,bttnlabel1);
			addChild(languagebutton);
			languagebttns.push(languagebutton);
			
			var languagebutton2 : LanguageButton = new LanguageButton(bttnurl2,bttnlabel2);
			addChild(languagebutton2);
			languagebttns.push(languagebutton2);
			
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