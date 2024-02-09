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
	
	public class WhiteBg extends MovieClip
	{
		
		private var global							: Global = Global.getInstance();
		private var stat							: Boolean = false;
		private var square							: Sprite;
		private var squarecolored					: Sprite;
		
		public function WhiteBg():void
		{
			
			this.alpha = 0;
			this.x = 216;
			global.root.resizewarning.push(this);
			init();
			
		}
		
		private function init():void {
			
			squarecolored = new Sprite();
			addChild(squarecolored);
			//square.graphics.lineStyle(0);
			squarecolored.graphics.beginFill(0xFFD300);
			squarecolored.graphics.drawRect(0,0,1,global.sh);
			squarecolored.graphics.endFill();
			
			square = new Sprite();
			addChild(square);
			//square.graphics.lineStyle(0);
			square.graphics.beginFill(0xFFFFFF);
			square.graphics.drawRect(0,0,1,global.sh);
			square.graphics.endFill();	
			
			
		}
		
		public function launch():void
		{
			
			Tweener.addTween( squarecolored, { width: global.sw - 216 , time:0.5 , transition:"easeOutExpo"} );
			squarecolored.alpha = 1;
			this.alpha = 1;
			Tweener.addTween( square, { width: global.sw - 216 , time:1 , transition:"easeOutExpo"} );
			squarecolored.height = global.sh;
			square.height = global.sh;
			square.alpha = 1;
			stat = true;
			
		}
		
		public function delaunch(delayval:Number=0):void
		{
			
			Tweener.addTween( squarecolored, { width: 1 , time:0.5 , transition:"easeOutExpo", delay:delayval, onComplete: function(){squarecolored.alpha = 0;square.alpha = 0;}} );
			//Tweener.addTween( this, { alpha: 0 , time:0.5 , transition:"easeOutExpo"} );
			Tweener.addTween( square, { width: 1 , time:0.2 , delay:delayval, transition:"easeOutExpo"} );
			stat=false;
			
		}
		
		public function StageResized(e:Event=null)
		{
			
			if(stat==true)
			{
				Tweener.addTween( squarecolored, { width: global.sw - 216 , time:0.5 , transition:"easeOutExpo"} );
				Tweener.addTween( square, { width: global.sw - 216 , time:1 , transition:"easeOutExpo"} );
				Tweener.addTween( squarecolored, { height: global.sh , time:0.5 , transition:"easeOutExpo"} );
				Tweener.addTween( square, { height: global.sh , time:1 , transition:"easeOutExpo"} );
			}
			
		}
		
	}
	
}