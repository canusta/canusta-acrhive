/*
* @author Can Usta
*/

package 
{
	
	import canusta.data.*;
	import canusta.text.*;
	import canusta.shapes.*;
	import flash.display.*;
	import flash.net.*;
	import lt.uza.utils.*;
	import flash.events.*;
	import XMLList;
	import lt.uza.utils.*
	import caurina.transitions.*;
	import flash.text.AntiAliasType;
	import flash.text.GridFitType;
	
	public class AboutLink extends MovieClip
	{
		
		private var lbl					: String;
		private var lnk					: String;
		
		public function AboutLink(plbl:String, plnk:String)
		{
			
			lbl = plbl;
			lnk = plnk;
			init();
			
		}
		
		private function init():void
		{
			
			var lnk : LeituraSansGrot3 = new LeituraSansGrot3();
			lnk.s.setStyle("s", {color:'#636363', fontSize:12, letterSpacing:0, leading:7});
			lnk.txt.embedFonts = true;
			lnk.txt.antiAliasType = AntiAliasType.ADVANCED;
			lnk.txt.gridFitType = GridFitType.PIXEL;
			lnk.txt.htmlText = "<s><a href='" + lbl + "'>" + lbl + "</a></s>";
			var _underline : Underline = new Underline(lnk.txt.width-4, 0x636363);
			addChild(_underline);
			_underline.y = 10;
			_underline.x = -1;
			addChild(lnk);
			arrow_mc.x = Math.round(lnk.width);
			arrow_mc.alpha = 0;
			lnk.addEventListener(MouseEvent.CLICK, clicked);
			lnk.addEventListener(MouseEvent.MOUSE_OVER, hover);
			lnk.addEventListener(MouseEvent.MOUSE_OUT, out);
			
		}
		
		private function clicked(e:Event):void
		{
			
			
			
		}
		
		private function hover(e:Event):void
		{
			
			Tweener.addTween( arrow_mc, { alpha: 1 , time:0.5 , transition:"easeOutExpo"} );
			
		}
		
		private function out(e:Event):void
		{
			
			Tweener.addTween( arrow_mc, { alpha: 0 , time:0.5 , transition:"easeOutExpo"} );
			
		}
		
	}
	
}