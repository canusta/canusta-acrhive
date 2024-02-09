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

public class BlendsContent extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	
	private var bttninfo						: Array;
	private var bttndb							: Array;
	private var bttnsy							: Number = 325;
	private var bttnxmargin						: Number = 316;
	private var chosenblend						: String;
	private var	blendscontentelma				: BlendsContentElma;
	private var	blendscontentnar				: BlendsContentNar;
	private var page							: DisplayObject;
	private var icindekilerlauched				: Boolean = false;
	
	public function BlendsContent(pchosenblend:String)
	{
		
		chosenblend = pchosenblend;
		bttninfo = new Array(['INGREDIENTS', 'TRY WITH', 'COCKTAIL'], ['icindekiler', 'uyumlu', 'kokteyl']);
		run();
		
	}
	
	private function run():void
	{
		
		if(chosenblend=='elma')
		{
			blendscontentelma = new BlendsContentElma();
			contenthere.addChild(blendscontentelma);
		}else
		{
			blendscontentnar = new BlendsContentNar();
			contenthere.addChild(blendscontentnar);
		}
		
		bttndb = new Array();
		for ( var i in bttninfo[0] ) {  
		    var bttn : BlendsButton = new BlendsButton(bttninfo[0][i], bttninfo[1][i], this);
			bttn.y = bttnsy + 200;
			Tweener.addTween( bttn, { y: bttnsy , time:0.5 , transition:"easeOutExpo", delay:i/5, onComplete:runFirst} );
			bttnhere.addChild(bttn);
			bttndb.push(bttn);
			bttn.x = bttnxmargin + ( i * 199 );
		}
		
	}
	
	private function runFirst():void
	{
		
		bttndb[0].clicked();
		
	}
	
	public function changePage(frame:String, bttn:BlendsButton):void
	{
		
		for ( var i in bttndb ) {
			if(bttn!=bttndb[i]){
				bttndb[i].activate();
			}
		}
			
		if(chosenblend=='elma')
		{
			blendscontentelma.gotoAndStop(frame)
			
		}else
		{
			blendscontentnar.gotoAndStop(frame)
		}
		
	}
	
}

}

