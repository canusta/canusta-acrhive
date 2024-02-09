/*
* @author Can Usta
*/

package 
{
	
	import canusta.data.*;
	import canusta.gui.*
	import flash.display.*;
	import flash.net.*;
	import flash.utils.*;
	import lt.uza.utils.*;
	import flash.events.*;
	import XMLList;
	import caurina.transitions.*;
	import SWFAddress;
	import SWFAddressEvent;
	
	public class Underline extends MovieClip
	{
		
		private var global							: Global = Global.getInstance();
		public var squarewidth						: Number;
		private var clr								: uint;
		
		public function Underline(psquarewidth:Number, pclr:uint=0x383838):void
		{
			
			squarewidth = psquarewidth;
			clr = pclr;
			init();
			
		}
		
		private function init():void {
			
			var square:Sprite = new Sprite();
			addChild(square);
			//square.graphics.lineStyle(0);
			square.graphics.beginFill(clr);
			square.graphics.drawRect(0,0,squarewidth,1);
			square.graphics.endFill();
			
		}
		
	}
	
}