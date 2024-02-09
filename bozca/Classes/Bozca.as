package
{
	
	import canusta.data.*;
	import flash.net.*;
	import flash.display.*;
	import lt.uza.utils.*;
	import flash.events.*;
	import flash.utils.*;
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

public class Bozca extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	
	public var screenw							: Number;
	public var screenh							: Number;
	public var screenx							: Number;
	public var screeny							: Number;
	public var stagew							: Number = 1000;
	public var stageh							: Number = 600;
	public var resizewarning					: Array;
	
	private var bosphorus						: BosphorusLogo;
	public var canvas							: MovieClip;
	public var inter 							: MovieClip;
	public var contents							: MovieClip;
	public var currentcontent					: DisplayObject;
	public var preloader						: Preloader;
	private var bant							: Bant;
	private var sixhegon						: Sixhegon;
	
	private var skndl							: Skndl;
	
	public function Bozca()
	{
		
		stage.scaleMode = StageScaleMode.NO_SCALE;
		//stage.displayState=StageDisplayState.FULL_SCREEN;
		global.root = this;
		resizewarning = new Array();
		calculatexy();
		stage.addEventListener(Event.RESIZE, resized);
		addCanvas();
		run();
		addPreloader();
		resized();
		
	}
	
	private function addCanvas():void
	{
		
		canvas = new MovieClip();
		addChild(canvas);
		canvas.x = canvas.y = 0;
		global.canvas = canvas;
		
	}
	
	private function run():void
	{
		
		addBosphorusLogo();
		addInter();
		addContents();
		addExpand();
		addSkndl();
		
	}
	
	private function addSkndl():void {
		
		skndl = new Skndl();
		addChild(skndl);
		resizewarning.push(skndl);
		
	}
	
	private function addBosphorusLogo():void
	{
		
		bosphorus = new BosphorusLogo();
		resizewarning.push(bosphorus);
		addChild(bosphorus);
		
	}
	
	private function addInter():void
	{
		
		inter = new Inter();
		inter.x = 20;
		inter.y = 5;	
		canvas.addChild(inter);
		
	}
	
	private function addContents():void
	{
		
		contents = new MovieClip();
		canvas.addChild(contents);
		
	}
	
	public function resized(e:Event=null):void {
		
		calculatexy();
		for(var i in resizewarning)
		{
			resizewarning[i].StageResized();
		}
		StageResized();
		
	}
	
	public function StageResized():void
	{
		
		////  CHECK RIGHT TOP
		if(global.sh<=717){
			lockTop();
		}else{
			unlockTop();
		}
		
	}
	
	private function lockTop():void
	{
		
		bosphorus.locked = true;
		sixhegon.locked = true;
		
	}
	
	private function unlockTop():void
	{
		
		bosphorus.locked = false;
		sixhegon.locked = false;
		
	}
	
	private function calculatexy():void
	{
		
		screenw = Math.round(stage.stageWidth);
		screenh = Math.round(stage.stageHeight);
		screenx = Math.round(0 - ( ( screenw - stagew) / 2 ));
		screeny = Math.round(0 - ( ( screenh - stageh) / 2 ));
		global.sw = screenw;
		global.sh = screenh;
		global.sx = screenx;
		global.sy = screeny;
		
	}
	
	private function addPreloader():void
	{
		
		preloader = new Preloader();
		canvas.addChild(preloader);
		
	}
	
	public function changePage(target:String):void
	{
		
	//	if(currentcontent){Tweener.addTween( currentcontent, { alpha: 0.25 , time:0.5 , transition:"easeOutExpo"} );}
		preloader.showit();
		loadSwf(target);
		
	}
	
	private function loadSwf(swf:String):void
	{
		
		var loader = new Loader();
		var swfRequest : URLRequest = new URLRequest(swf);
		loader.contentLoaderInfo.addEventListener(Event.COMPLETE, swfLoaded);
		loader.load(swfRequest);
		
	}
	
	private function swfLoadedx(e:Event):void
	{
		var myTimer:Timer = new Timer(1000,1);
		myTimer.addEventListener('timer', swfLoaded);
		myTimer.start();
	}
	
	private function swfLoaded(e:Event):void
	{
		
		preloader.hideit();
		var i:int = contents.numChildren;
		if(i>=1){while (i--) contents.removeChildAt(i);}
		currentcontent = e.target.content;
		contents.addChild(e.target.content);
		
	}
	
	public function addExpand():void
	{
		
		bant = new Bant();
		bant.alpha = 0;
		canvas.addChild(bant);
		sixhegon = new Sixhegon();
		resizewarning.push(sixhegon);
		sixhegon.alpha = 0;
		canvas.addChild(sixhegon);
		
	}
	
	public function Expand():void
	{
		
		Tweener.addTween( bant, { alpha: 1 , time:1 , transition:"easeOutExpo"} );
		Tweener.addTween( sixhegon, { alpha: 1 , time:1 , transition:"easeOutExpo"} );
		
	}
	
	public function Contract():void
	{
		
		Tweener.addTween( bant, { alpha: 0 , time:1 , transition:"easeOutExpo"} );
		Tweener.addTween( sixhegon, { alpha: 0 , time:1 , transition:"easeOutExpo"} );
		
	}
	
}

}

