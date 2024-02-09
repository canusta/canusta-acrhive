/*
* @author Can Usta
*/

package 
{
	

	import flash.text.*;
	import flash.display.*;
	import flash.events.*;
	import flash.utils.*;
	import flash.net.*;
	import lt.uza.utils.*;
	import caurina.transitions.*;
	
	public class LanguageButton extends MovieClip
	{
		
		private var global							: Global = Global.getInstance();
		private var url					: String;
		private var buttonlabel				: String;
		
		public function LanguageButton( purl:String , pbuttonlabel:String ):void
		{
			
			url = purl;
			buttonlabel = pbuttonlabel;
			init();
			
		}
		
		private function init():void {
			
			var txt : LeituraSansGrot3 = new LeituraSansGrot3();
			txt.s.setStyle("s", {color:'#FFFFFF', fontSize:10, letterSpacing:1});
			txt.txt.htmlText =  "<s>"+buttonlabel+"</s>";
			txt.x = 10;
			txt.y = 10;
			addChild(txt);
			bg.width = Math.round(txt.width + 14);
			bttn.width = Math.round(txt.width + 14);

			buttonize();
			
		}
		
		private function buttonize() {
			
			this.setChildIndex (this.getChildByName('bttn'), (this.numChildren - 1));
			bttn.addEventListener(MouseEvent.CLICK, bttnclicked);
			bttn.addEventListener(MouseEvent.MOUSE_OVER, bttnover);
			bttn.addEventListener(MouseEvent.MOUSE_OUT, bttnout);
			
		}
		
		private function bttnclicked(e:Event) {
			
			var turl:String = url;
			var request:URLRequest = new URLRequest(turl);
			navigateToURL(request, '_self');
			//global.trc.text = turl;
			
		}
		
		private function bttnover(e:Event) {
			
			Tweener.addTween( bg, { height: 38 , time:0.5 , transition:"easeOutExpo"} );
			Tweener.addTween( bg, { y: -5 , time:0.5 , transition:"easeOutExpo"} );
			
		}
		
		private function bttnout(e:Event) {
			
			Tweener.addTween( bg, { height: 28 , time:0.5 , transition:"easeOutExpo"} );
			Tweener.addTween( bg, { y: 0 , time:0.5 , transition:"easeOutExpo"} );
			
		}
		
	}
	
}