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
	import flash.utils.*;
	import XMLList;
	import lt.uza.utils.*
	import caurina.transitions.*;
	import flash.text.AntiAliasType;
	import flash.text.GridFitType;
	
	public class News extends MovieClip
	{
		
		private var global							: Global = Global.getInstance();
		private var db								: Object;
		private var bg								: MovieClip = new MovieClip();
		private var _itemdb							: Array = new Array();
		private var _itemcontainer					: MovieClip = new MovieClip();
		private var currentitem						: Number = 0;
		private var myTimer							: Timer;
		
		public function News():void
		{
			
			global.root.currentcontent = this;
			global.root.resizewarning.push(this);
			db = global.db.page.(@lnk=='/news/').*;
			this.x = 263;
			this.y = 157;
			init();
			
		}
		
		private function init():void
		{
			
			global.root.whitebg.launch();
			addBg();
			addNews();
			addScroll();
			
		}
		
		private function addScroll() {
			
			global.root.addEventListener(MouseEvent.MOUSE_MOVE, mouseMoved);
			
		}
		
		private function mouseMoved(e:Event)
		{
			
			if(checkMouse()==true)
			{
				scroll();
			}else{
				Tweener.addTween( _itemcontainer, { y: 0 , time:0.5 , transition:"easeOutExpo"} );
			}
			
		}
		
		private function scroll():void
		{
			
			if(this.mouseY>=0 && this.mouseX >=0)
			{
				
				var mouseareaheight : Number = global.sh-200;
				var diff : Number = Math.round( _itemcontainer.height - mouseareaheight );
				var mousepercent : Number = ( 100 * mouseY ) / mouseareaheight;
				var targety : Number = 0 - Math.round( ( ( mousepercent * diff ) / 100 ) );
				Tweener.addTween( _itemcontainer, { y: targety , time:0.5 , transition:"easeOutExpo"} );
				
			}else{
				Tweener.addTween( _itemcontainer, { y: 0 , time:0.5 , transition:"easeOutExpo"} );
			}
			
		}
		
		private function checkMouse():Boolean
		{
			
			if(_itemcontainer.height>= global.sh-200)
			{return true}else{return false}
			
		}
		
		
		private function addNews()
		{
			
			addChild(_itemcontainer);
			myTimer = new Timer(100, db.length());
			myTimer.addEventListener("timer", addAnItem);
			myTimer.start();
			
		}
		
		private function addAnItem(e:TimerEvent):void
		{
			
			var _item : NewsItem = new NewsItem( db[currentitem].date, db[currentitem].txt, db[currentitem].lnk );
			_itemdb.push(_item);
			_itemcontainer.addChild(_item);
			if(currentitem>=1)
			{
				_item.y = _itemdb[currentitem-1].height + _itemdb[currentitem-1].y + 34;
			}
			currentitem++;	
		
		}
		
		private function addBg()
		{
			
			addChild(bg);
			bg.alpha = 0;
			var square : Sprite = new Sprite();
			bg.addChild(square);
			square.graphics.beginFill(0xFFFFFF);
			square.graphics.drawRect(0,0,100,425);
			square.graphics.endFill();
			
		}
		
		public function transout()
		{
			
			global.root.removeEventListener(MouseEvent.MOUSE_MOVE, mouseMoved);
			global.root.whitebg.delaunch();
			for(var i in _itemdb)
			{
				Tweener.addTween( _itemdb[i], { alpha:0 , time:0.2 , transition:"easeOutExpo", delay:i/30} );
			}
			var myTimer:Timer = new Timer(500);
			myTimer.addEventListener('timer', changeLink);
			myTimer.start();
			
		}
		
		public function changeLink(e:Event)
		{
			global.root.changelink();
		}
		
		public function StageResized(e:Event=null):void
		{
			//resized();
		}
		
	}
	
}