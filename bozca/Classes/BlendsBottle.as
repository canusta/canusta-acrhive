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
import com.greensock.*;
import com.greensock.plugins.*;

public class BlendsBottle extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	private var owner							: Blends;
	
	private var preference						: String;
	private var thisy							: Number = 40;
	private var elmax							: Number = 342;
	private var narx							: Number = 490;
	private var thisw							: Number;
	private var thish							: Number;
	private var currentx						: Number;
	
	public function BlendsBottle(ppreference:String, powner:Blends)
	{
		
		preference = ppreference;
		owner = powner;
		thisw = this[preference].width;
		thish = this[preference].height;
		var myTimer:Timer = new Timer(1000, 1);
		myTimer.addEventListener('timer', run);
		myTimer.start();

	}
	
	private function run(e:Event=null):void
	{
		
		this[preference].alpha = 1;
		this.y = -2000;
		
		this[preference].width = thisw*10;
		this[preference].height = thish*10;
		
		TweenPlugin.activate([TintPlugin]);
		TweenLite.to(this, 0, {tint:0x000000});
		
		if(preference=='elma')
		{
			this.x = elmax - 1400;
			currentx = elmax;
			Tweener.addTween( this, { x: elmax , time:4 , transition:"easeOutExpo"} );
		}else
		{
			this.x = narx + 1000;
			currentx = narx;
			Tweener.addTween( this, { x: narx , time:4 , transition:"easeOutExpo"} );
		}
		
		Tweener.addTween( this[preference], { width: thisw , time:2 , transition:"easeOutExpo"} );
		Tweener.addTween( this[preference], { height: thish , time:2 , transition:"easeOutExpo"} );
		Tweener.addTween( this, { y: thisy , time:2 , transition:"easeOutExpo", onComplete:buttonize} );
		TweenPlugin.activate([RemoveTintPlugin])
		TweenLite.to(this, 6, {removeTint:true});
		
	}
	
	private function buttonize(e:Event=null):void
	{
		
		bttn.addEventListener(MouseEvent.CLICK, clicked);
		bttn.addEventListener(MouseEvent.MOUSE_OVER, hover);
		bttn.addEventListener(MouseEvent.MOUSE_OUT, out);
		
	}
	
	private function debuttonize():void
	{
		
		bttn.removeEventListener(MouseEvent.CLICK, clicked);
		bttn.removeEventListener(MouseEvent.MOUSE_OVER, hover);
		bttn.removeEventListener(MouseEvent.MOUSE_OUT, out);
		
	}
	
	private function clicked(e:Event=null):void
	{
		
		owner.chosen(preference);
		
	}
	
	private function hover(e:Event=null):void
	{
		
		owner.hover(preference);
		
	}
	
	private function out(e:Event=null):void
	{
		
		owner.out();
		
	}
	
	public function front():void
	{
		
		Tweener.addTween( this[preference], { width: thisw*1.1 , time:1 , transition:"easeOutExpo"} );
		Tweener.addTween( this[preference], { height: thish*1.1 , time:1 , transition:"easeOutExpo"} );
		Tweener.addTween( this[preference], { y: -20 , time:1 , transition:"easeOutExpo"} );
		if(preference=='elma')
		{Tweener.addTween( this[preference], { x: 40 , time:1 , transition:"easeOutExpo"} );}else
		{Tweener.addTween( this[preference], { x: -70 , time:1 , transition:"easeOutExpo"} );}
		//Tweener.addTween( this[preference].badge, { alpha:1 , time:1 , transition:"easeOutExpo"} );
		
	}
	
	public function back():void
	{
		
		Tweener.addTween( this[preference], { width: thisw*0.85 , time:1 , transition:"easeOutExpo"} );
		Tweener.addTween( this[preference], { height: thish*0.85 , time:1 , transition:"easeOutExpo"} );
		Tweener.addTween( this[preference], { y: 20 , time:1 , transition:"easeOutExpo"} );
		if(preference=='elma')
		{Tweener.addTween( this[preference], { x: 40 , time:1 , transition:"easeOutExpo"} );}else
		{Tweener.addTween( this[preference], { x: -40 , time:1 , transition:"easeOutExpo"} );}
		TweenPlugin.activate([TintPlugin]);
		//TweenLite.to(this, 0, {tint:0x000000, tintAmount:0.5});
		
	}
	
	public function middle():void
	{
		
		Tweener.addTween( this[preference], { width: thisw , time:1 , transition:"easeOutExpo"} );
		Tweener.addTween( this[preference], { height: thish , time:1 , transition:"easeOutExpo"} );
		Tweener.addTween( this[preference], { y: -15 , time:1 , transition:"easeOutExpo"} );
		Tweener.addTween( this[preference], { x: 0 , time:1 , transition:"easeOutExpo"} );
		Tweener.addTween( this[preference].badge, { alpha:0 , time:1 , transition:"easeOutExpo"} );
		
	}
	
	public function chosen():void
	{
		
		debuttonize();
		middle();
		
	}
	
	public function notchosen():void
	{
		
		debuttonize();
		middle();
		
	}
	
}

}

