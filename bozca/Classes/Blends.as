package
{
	
import canusta.data.*;
import flash.utils.*;
import flash.text.*;
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

public class Blends extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	
	private var bg								: BG;
	private var bottleelma						: BlendsBottle;
	private var bottlenar						: BlendsBottle;
	private var choose							: ChooseYourBlend;
	private var obj								: BlendsBottle;
	private var otherobj						: BlendsBottle;
	private var chosenblend						: BlendsBottle;
	private var notchosenblend					: BlendsBottle;
	private var blendscontent					: BlendsContent;
	
	public function Blends()
	{
		
		run();
		
	}
	
	private function run():void
	{
		
		if(global.root)
		{
			global.root.Expand();
		}
		
		bg = new BG();
		bg.alpha = 0;
		here.addChild(bg);
		Tweener.addTween( bg, { alpha: 1 , time:1 , transition:"easeInExpo"} );
		
		bottleelma = new BlendsBottle('elma', this);
		here.addChild(bottleelma);
		bottlenar = new BlendsBottle('nar', this);
		here.addChild(bottlenar);
		
		var myTimer:Timer = new Timer(3000, 1);
		myTimer.addEventListener('timer', addChoose);
		myTimer.start();
		
	}
	
	private function addChoose(e:Event=null):void
	{
		
		choose = new ChooseYourBlend();
		choose.x = 682;
		choose.y = 450;
		//choose.alpha = 0;
		here.addChild(choose);
		//Tweener.addTween( choose, { alpha: 1 , time:3 , transition:"easeOutExpo"} );
		Tweener.addTween( choose, { y: 207 , time:3 , transition:"easeOutExpo"} );
		
	}
	
	public function hover(objname:String):void
	{
		
		if(objname=='elma')
		{
			obj = bottleelma;
			otherobj = bottlenar;
		}else
		{
			obj = bottlenar;
			otherobj = bottleelma;
		}
		
		this.here.setChildIndex (this.here.getChildByName(String(obj.name)), (this.here.numChildren - 1));
		obj.front();
		otherobj.back();
		Tweener.addTween( choose, { y: 450 , time:3 , transition:"easeOutExpo"} );
		
	}
	
	public function out():void
	{
		
		obj.middle();
		otherobj.middle();
		
	}
	
	public function chosen(objname:String):void
	{
		
		if(objname=='elma')
		{
			chosenblend = bottleelma;
			notchosenblend = bottlenar;
		}else
		{
			chosenblend = bottlenar;
			notchosenblend = bottleelma;
		}
		if(chosenblend==bottleelma)
		{
			bottleelma.chosen();
			bottlenar.notchosen();
		}else
		{
			bottleelma.notchosen();
			bottlenar.chosen();
		}
		
		var myTimer:Timer = new Timer(1000, 1);
		myTimer.addEventListener('timer', runchosen);
		myTimer.start();
		
	}
	
	private function runchosen(e:Event=null):void
	{
		
		Tweener.addTween( chosenblend, { x: 50 , time:1 , transition:"easeOutExpo", onComplete:addContent} );
		Tweener.addTween( notchosenblend, { alpha: 0 , time:1 , transition:"easeOutExpo"} );
		Tweener.addTween( bg.white, { alpha: 1 , time:1 , transition:"easeOutExpo"} );
		
	}

	private function addContent(e:Event=null):void
	{
		if(chosenblend==bottleelma)
		{
			blendscontent = new BlendsContent('elma');
		}else
		{
			blendscontent = new BlendsContent('nar');
		}
		here.addChild(blendscontent);
		
	}
	
}

}

