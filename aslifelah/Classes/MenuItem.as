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
	import caurina.transitions.*;
	import flash.text.*;
	
	public class MenuItem extends MovieClip
	{
		
		private var global							: Global = Global.getInstance();
		private var _menu							: Menu = global._menu;
		private var menulabel						: String;
		private var menuid							: Number;
		private var arrowx							: Number;
		private var txtx							: Number;
		private var stat							: Boolean = false;
		private var lnk								: String;
		private var typ								: String;
		
		public function MenuItem(pmenuid:Number, pmenulabel:String, plnk:String, ptyp:String, pstat:Boolean):void
		{
			
			menuid = pmenuid;
			menulabel = pmenulabel;
			lnk = plnk;
			typ = ptyp;
			stat = pstat;
			
			this.alpha = 0;
			Tweener.addTween(this, { alpha: 1, time:4, transition:"easeOutExpo", delay:menuid/10} );  // sirayla gelmeleri icin
			
			txt.autoSize = TextFieldAutoSize.LEFT;
			
			var s:StyleSheet = new StyleSheet();
			s.setStyle("menu", {letterSpacing:0.5});
			txt.styleSheet = s;
			txt.htmlText = "<menu>"+menulabel+"</menu>";
			txtx = txt.x;
			
			arrow_mc.x = Math.round(txt.width);
			arrowx = Math.round(txt.width);
			arrow_mc.alpha = 0;
			
			yellow_mc.width = Math.round(txt.width) + 28;
			white_mc.width = Math.round(txt.width) + 28;
			bttn_mc.width = Math.round(txt.width) + 28;
			yellow_mc.alpha = 0;
			white_mc.alpha = 0;
			
			buttonize();
			
			if (stat==true) {
				
			}
			
		}
		
		private function buttonize():void {
			
			this.addEventListener(MouseEvent.CLICK, mouseclick);
			this.addEventListener(MouseEvent.MOUSE_OVER, mouseover);
			this.addEventListener(MouseEvent.MOUSE_OUT, mouseout);
			
		}
		
		private function mouseover(e:Event):void {
			
			if(stat==false)
			{
				Tweener.removeTweens(white_mc);
				Tweener.removeTweens(yellow_mc);
				white_mc.width = 1;
				yellow_mc.width = 1;
				yellow_mc.alpha = 1;
				white_mc.alpha = 1;
				Tweener.addTween(txt, { x: 10, time:1, transition:"easeOutExpo" } );
				//Tweener.addTween(arrow_mc, { x: arrowx+13, time:1, transition:"easeOutExpo" } );
				//Tweener.addTween(arrow_mc, { alpha: 1, time:1, transition:"easeOutExpo" } );
				Tweener.addTween(white_mc, { width: bttn_mc.width-10, time:1, transition:"easeOutExpo" } );
				Tweener.addTween(yellow_mc, { width: bttn_mc.width-10, time:0.5, transition:"easeOutExpo" } );
				Tweener.addTween(white_mc, { x: 0, time:1, transition:"easeOutExpo" } );
				Tweener.addTween(yellow_mc, { x: 0, time:1, transition:"easeOutExpo" } );
				
			}
			
			if(menuid==0 && global.yatchmode == 1)
			{
				Tweener.addTween(arrow_mc, { rotation: 180, time:1, transition:"easeOutExpo" } );
				Tweener.addTween(arrow_mc, { y: 5, time:1, transition:"easeOutExpo" } );
			}
			
		}
		
		private function mouseout(e:Event):void {
			
			if(stat==false)
			{
				Tweener.addTween(txt, { x: txtx, time:1, transition:"easeOutExpo" } );
				Tweener.addTween(white_mc, { width: 1, time:0.5, transition:"easeOutExpo", onComplete:function(){white_mc.alpha=0} } );
				//Tweener.addTween(arrow_mc, { x: arrowx, time:1, transition:"easeOutExpo" } );
				//Tweener.addTween(arrow_mc, { alpha: 0, time:1, transition:"easeOutExpo" } );
				Tweener.addTween(yellow_mc, { width: 1, time:1, transition:"easeOutExpo" } );
				Tweener.addTween(yellow_mc, { alpha: 0, time:1, transition:"easeOutExpo" } );
				Tweener.addTween(white_mc, { x: -10, time:1, transition:"easeOutExpo" } );
				Tweener.addTween(yellow_mc, { x: -10, time:1, transition:"easeOutExpo" } );
			}
			
			if(menuid==0 && global.yatchmode == 1)
			{
				Tweener.addTween(arrow_mc, { rotation: 0, time:1, transition:"easeOutExpo" } );
				Tweener.addTween(arrow_mc, { y: 4, time:1, transition:"easeOutExpo" } );
			}
			
		}
		
		private function mouseclick(e:Event=null):void {
			
			if(menuid ==0 && global.yatchmode == 1)
			{
				Tweener.addTween(arrow_mc, { rotation: 0, time:1, transition:"easeOutExpo" } );
				Tweener.addTween(arrow_mc, { y: 4, time:1, transition:"easeOutExpo" } );
			}
			
			if(stat==false || global.yatchmode == 1)
			{
				global.root.nextlink=lnk;
				global.root.currentcontent.transout();
			}
			
			trace(global.yatchmode)
			
		}
		
		public function activate(e:Event=null):void{
			
			Tweener.addTween(arrow_mc, { alpha: 0, time:1, transition:"easeOutExpo" } );
			stat = false;
			
		}
		
		public function deactivate() {
			
			if(stat==false)
			{
				Tweener.addTween(txt, { x: txtx, time:1, transition:"easeOutExpo" } );
				Tweener.addTween(white_mc, { width: 1, time:0.5, transition:"easeOutExpo", onComplete:function(){white_mc.alpha=0} } );
				Tweener.addTween(arrow_mc, { x: arrowx+3, time:1, transition:"easeOutExpo" } );
				Tweener.addTween(arrow_mc, { alpha: 1, time:3, transition:"easeOutExpo" } );
				Tweener.addTween(yellow_mc, { width: 1, time:1, transition:"easeOutExpo" } );
				Tweener.addTween(yellow_mc, { alpha: 0, time:1, transition:"easeOutExpo" } );
				Tweener.addTween(white_mc, { x: -10, time:1, transition:"easeOutExpo" } );
				Tweener.addTween(yellow_mc, { x: -10, time:1, transition:"easeOutExpo" } );
				stat = true;
				_menu.switchmenu(lnk, menuid);
			}
			
			stat = true;
			
		}
		
		
	}
	
}