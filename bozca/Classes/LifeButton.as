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

public class LifeButton extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	
	private var _label							: String;
	private var frame							: String;
	private var stat							: Boolean = false;
	private var owner							: Life;
	
	public function LifeButton(plabel:String, pframe:String, powner:Life)
	{
		
		_label = plabel;
		frame = pframe;
		owner = powner;
		run();
		
	}
	
	private function run():void
	{
		
		txt.txt.text = _label;
		buttonize();
		
	}
	
	private function buttonize():void
	{
		
		bttn.addEventListener(MouseEvent.CLICK, clicked);
		bttn.addEventListener(MouseEvent.MOUSE_OVER, over);
		bttn.addEventListener(MouseEvent.MOUSE_OUT, out);
		
	}
	
	public function clicked(e:Event=null):void
	{
		
		if(stat==false)
		{
			owner.changePage(frame, this);
			deactivate();
		}
		
	}
	
	private function over(e:Event=null):void
	{
		if(stat==false)
		{
			
			Tweener.addTween( hover, { alpha: 0.75 , time:0.5 , transition:"easeOutExpo"} );
		
		}
	}
	
	private function out(e:Event=null):void
	{
		
		if(stat==false)
		{
			
			Tweener.addTween( hover, { alpha: 0 , time:0.5 , transition:"easeOutExpo"} );
			
		}
		
	}
	
	public function activate():void
	{
		
		//Tweener.addTween( hover, { alpha: 0 , time:0.5 , transition:"easeOutExpo"} );
		stat=false;
		out();
	}
	
	public function deactivate():void
	{
		over();
		stat=true;
	}
	
}

}

