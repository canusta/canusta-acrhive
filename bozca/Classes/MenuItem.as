package
{
	
	import flash.display.*;
	import canusta.data.*;
	import flash.display.*;
	import lt.uza.utils.*;
	import flash.events.*;
	import XMLList;
	import Math;
	import com.hydrotik.queueloader.QueueLoader;
	import com.hydrotik.queueloader.QueueLoaderEvent;
	import lt.uza.utils.*
	import caurina.transitions.*;
	import flash.events.TimerEvent;
    import flash.display.Sprite;
    import flash.net.NetConnection;
    import flash.net.NetStream;
    import flash.media.Video;
    import flash.events.AsyncErrorEvent;

public class MenuItem extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	
	private var _label : String;
	private var _place : int;
	private var _swf : String;
	private var txth : GothamRoundedBold;
	private var txto : GothamRoundedBold;
	private var button : Sprite;
	private var hover : MovieClip;
	private var out : MovieClip;
	
	public var stat : Boolean = true;
	
	public function MenuItem(plabel, pplace, pswf)
	{
		
		_label = plabel;
		_place = pplace;
		_swf = pswf;
		
		addHover();
		addOut();
		addMask();
		
		addButton()
		
	}
	
	public function deactivate(e:Event=null):void
	{
		
		debuttonize();
		stat = false;
		
	}
	
	private function addHover():void
	{
		
		hover = new MovieClip();
		addChild(hover);
		
		txth = new GothamRoundedBold();
		
		if(_place==1){
			
			txth.s.setStyle("s", {color:'#FFFFFF', fontSize:12, letterSpacing:0, leading:7});
			
		}
		
		if(_place==2){
			
			txth.s.setStyle("s", {color:'#FFFFFF', fontSize:12, letterSpacing:0, leading:7});
			
		}
		
		txth.txt.wordWrap = false;
		txth.txt.htmlText = "<s>"+_label+"</s>";
		txth.y = 0-txth.height + 8;
		hover.addChild(txth);
		
	}
	
	private function addOut():void
	{
		
		out = new MovieClip();
		addChild(out);
		
		txto = new GothamRoundedBold();
		
		if(_place==1){
			
			txto.s.setStyle("s", {color:'#FFFFFF', fontSize:12, letterSpacing:0, leading:7});
			
		}
		
		if(_place==2){
			
			txto.s.setStyle("s", {color:'#FFFFFF', fontSize:12, letterSpacing:0, leading:7});
			
		}
		
		txto.txt.wordWrap = false;
		txto.txt.htmlText = "<s>"+_label+"</s>";
		txto.alpha = 0.4;
		out.addChild(txto);
		
	}
	
	private function addButton():void
	{
		
		button = new Sprite();
		addChild(button);
		//square.graphics.lineStyle(0);
		button.graphics.beginFill(0xFFFFFF);
		button.graphics.drawRect(-10,-10,txto.width+20,txto.height+5);
		button.graphics.endFill();
		button.alpha = 0;
		
		buttonize();
		
	}
	
	private function addMask():void
	{
		
		var _maskh : Sprite = new Sprite();
		addChild(_maskh);
		//square.graphics.lineStyle(0);
		_maskh.graphics.beginFill(0xFFFF00);
		_maskh.graphics.drawRect(0,0,txto.width,txto.height-6);
		_maskh.graphics.endFill();
		_maskh.y = -3;
		txth.mask = _maskh;
		
		var _masko : Sprite = new Sprite();
		addChild(_masko);
		//square.graphics.lineStyle(0);
		_masko.graphics.beginFill(0xFFFF00);
		_masko.graphics.drawRect(0,0,txto.width,txto.height-6);
		_masko.graphics.endFill();
		_masko.y = -3;
		txto.mask = _masko
		
		
	}
	
	private function buttonize():void
	{
		
		button.addEventListener(MouseEvent.CLICK, clicked);
		button.addEventListener(MouseEvent.MOUSE_OVER, over);
		button.addEventListener(MouseEvent.MOUSE_OUT, bout);
		
	}
	
	private function debuttonize():void
	{
		
			button.removeEventListener(MouseEvent.CLICK, clicked);
			button.removeEventListener(MouseEvent.MOUSE_OVER, over);
			button.removeEventListener(MouseEvent.MOUSE_OUT, bout);
		
	}
	
	private function clicked(e:Event=null)
	{
		
		over();
		if(global.currentmenu){global.currentmenu.activate();}
		global.currentmenu = this;
		stat = false;
		global.root.changePage(_swf);
		
	}
	
	private function over(e:Event=null)
	{
		if(stat==true)
		{
			Tweener.addTween( txth, { y:0 , time:0.5 , transition:"easeOutExpo"} );
			Tweener.addTween( txto, { y:txto.height-4 , time:0.5 , transition:"easeOutExpo"} );
		}
	}
	
	private function bout(e:Event=null)
	{
		if(stat==true)
		{
			Tweener.addTween( txth, { y:0-txto.height+4 , time:0.5 , transition:"easeOutExpo"} );
			Tweener.addTween( txto, { y:0 , time:0.5 , transition:"easeOutExpo"} );
		}
	}
	
	public function activate()
	{
		
		stat = true;
		bout();
		
	}
	
	public function go():void
	{
		
		clicked();
		
	}
	
	
}

}

