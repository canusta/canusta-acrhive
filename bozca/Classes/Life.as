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
import flash.geom.Rectangle;

public class Life extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	private var bttninfo						: Array;
	private var bttndb							: Array;
	private var bttnsy							: Number = 440;
	private var bttnxmargin						: Number = 381;
	private var chosenblend						: String;
	private var page							: DisplayObject;
	private var icindekilerlauched				: Boolean = false;
	private var curr							: Number = 1;
	private var scrollbar						: MovieClip;
	
	public function Life()
	{
		
		bttninfo = new Array(['TESTIMONIALS', 'FAQ'], ['testimonials', 'faq']);
		run();
		
	}
	
	private function run():void
	{
		
		bttndb = new Array();
		for ( var i in bttninfo[0] ) {  
		    var bttn : LifeButton = new LifeButton(bttninfo[0][i], bttninfo[1][i], this);
			bttn.y = bttnsy + 200;
			Tweener.addTween( bttn, { y: bttnsy , time:0.5 , transition:"easeOutExpo", delay:i/5, onComplete:runFirst} );
			addChild(bttn);
			bttndb.push(bttn);
			bttn.x = bttnxmargin + ( i * 199 );
		}
		
		scrollize();
		
	}
	
	private function scrollize():void
	{
		
		scrollbar = muvi.muvi.faq.scrll;
		scrollbar.buttonMode = true;
		
		scrollbar.addEventListener(MouseEvent.MOUSE_DOWN, mouseDownHandler);
		scrollbar.addEventListener(MouseEvent.MOUSE_UP, mouseUpHandler);
		
	}
	
	function mouseDownHandler(evt:MouseEvent):void{
		var rectangle:Rectangle = new Rectangle(537, 0, 0, 218);
		scrollbar.startDrag(false, rectangle);
		this.addEventListener(MouseEvent.MOUSE_MOVE, update)
	}
	
	private function update(e:Event=null):void
	{
		
		var scrolly : Number = scrollbar.y;
		var scrollfull : Number = 218;
		var txtheight : Number = muvi.muvi.faq.txt.height+20;
		var txt : MovieClip = muvi.muvi.faq.txt;
		var txty : Number;
		var txtmovingarea : Number = txtheight - 228;
		Tweener.addTween( txt, { y: 27-(scrolly * txtmovingarea / 218) , time:2, transition:"easeOutExpo"} );
		
	}


	function mouseUpHandler(evt:MouseEvent):void{
		scrollbar.stopDrag();
	}
	
	private function runFirst():void
	{
		
		bttndb[0].clicked();
		
	}
	
	public function changePage(frame:String, bttn:LifeButton):void
	{
		
		for ( var i in bttndb ) {
			if(bttn!=bttndb[i]){
				bttndb[i].activate();
			}
		}
		
		if(curr==0)
		{
			Tweener.addTween( muvi.muvi.testim, { alpha: 0 , time:0.5 , transition:"easeOutExpo"} );
			Tweener.addTween( muvi.muvi.faq, { alpha: 1 , time:0.5 , transition:"easeOutExpo"} );
			curr=1;
		}else{
			Tweener.addTween( muvi.muvi.testim, { alpha: 1 , time:0.5 , transition:"easeOutExpo"} );
			Tweener.addTween( muvi.muvi.faq, { alpha: 0 , time:0.5 , transition:"easeOutExpo"} );
			curr=0;
		}
		
		trace('adsa')
		
	}
	
}

}

