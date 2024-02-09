package
{
	
import canusta.data.*;
import flash.utils.*;
import flash.net.*;
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

public class Inter extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	
	private var menudb							: Array;
	private var menuinfodb						: Array;
	private var menuplacedb						: Array;
	private var swfdb							: Array;
	private var menu1x							: int = 118;
	private var menu1y							: int = 44;
	private var menu2x							: int = 10;
	private var menu2y							: int = 552;
	private var menu1lastitemx					: int = 0;
	private var menu2lastitemx					: int = 0;
	private var menuopenspeed					: Number = 0.3;
	
	public function Inter()
	{
		
		menudb = new Array();
		menuinfodb = new Array('HOME', 'BOZCA', 'BLENDS', 'LIFE', 'FIND BOZCA', 'ORDER', 'CONTACT');
		swfdb = new Array('home.swf', 'about.swf', 'blends.swf', 'life.swf', 'findbozca.swf', 'order.swf', 'contact.swf');
		menuplacedb = new Array(1,1,1,1,2,2,2);
		
		Tweener.addTween( logo_mc, { alpha: 0 , time:0 , transition:"easeOutExpo"} );
		Tweener.addTween( logo_mc, { alpha: 1 , time:6 , transition:"easeOutExpo"} );
		addMenus();
		addBubbles();
		launchHome();
		
	}
	
	private function addMenus():void
	{
		
		for ( var i in menuinfodb ) {  
		    var bttn : MenuItem = new MenuItem( menuinfodb[i], menuplacedb[i], swfdb[i] );
			var menusep : MenuSep = new MenuSep(); 
			
			if(menuplacedb[i]==1)
			{
				
				bttn.x = menu1x + menu1lastitemx;
				menu1lastitemx =  menu1lastitemx + bttn.width + 20;
				bttn.y = menu1y;
				menusep.x = Math.round(bttn.x + bttn.width) + 0;
				menusep.y = menu1y-3;
				
			}
			
			if(menuplacedb[i]==2)
			{
				
				bttn.x = menu2x + menu2lastitemx;
				menu2lastitemx =  menu2lastitemx + bttn.width + 20;
				bttn.y = menu2y;
				menusep.x = Math.round(bttn.x + bttn.width) +0;
				menusep.y = menu2y-3;
				
			}
			
			menudb.push(bttn);
			
			addChild(bttn);
			if(menuplacedb[i]==menuplacedb[i+1])
			{
				addChild(menusep);
				Tweener.addTween( menusep, { alpha: 0 , time:0 , transition:"easeOutExpo"} );
				Tweener.addTween( menusep, { alpha: 1 , time:3 , transition:"easeOutExpo", delay:i*menuopenspeed} );	
			}
			
			Tweener.addTween( bttn, { alpha: 0 , time:0 , transition:"easeOutExpo"} );
			Tweener.addTween( bttn, { alpha: 1 , time:3 , transition:"easeOutExpo", delay:i*menuopenspeed} );
			
		}
		
		var menusepfb : MenuSep = new MenuSep();
		menusepfb.alpha = 0;
		addChild(menusepfb);
		menusepfb.x = menu2lastitemx-20;
		menusepfb.y = menu2y-3;
		Tweener.addTween( menusepfb, { alpha: 1 , time:3 , transition:"easeOutExpo", delay:(i+1)*menuopenspeed} );
		
		var facebook : Facebook = new Facebook();
		addChild(facebook);
		facebook.alpha = 0 ;
		facebook.x = menu2lastitemx + 10;
		facebook.y = menu2y;
		Tweener.addTween( facebook, { alpha: 1 , time:3 , transition:"easeOutExpo", delay:(i+1)*menuopenspeed} );
		
		facebook.fblogo.buttonMode = true;
		facebook.fblogo.addEventListener(MouseEvent.CLICK, fbclick);
		facebook.fblogo.addEventListener(MouseEvent.MOUSE_OVER, fbover);
		facebook.fblogo.addEventListener(MouseEvent.MOUSE_OUT, fbout);
		
	}
	
	private function fbover(e:Event)
	{
		Tweener.addTween( e.currentTarget.parent.txt, { alpha: 1 , time:3 , transition:"easeOutExpo"});
	}
	
	private function fbout(e:Event=null)
	{
		Tweener.addTween( e.currentTarget.parent.txt, { alpha: 0 , time:3 , transition:"easeOutExpo"});
	}
	
	private function fbclick(e:Event)
	{
		fbout(e);
		var url:String = "http://www.facebook.com/home.php?#!/pages/BOZCA/106940152690778";
		var request:URLRequest = new URLRequest(url);
		navigateToURL(request, '_blank');
	}
	
	private function launchHome():void
	{
		
		// Create a new Timer object with a delay of 500 ms
		var myTimer:Timer = new Timer(2000, 1);
		myTimer.addEventListener('timer', launchHomeNow);

		// Start the timer
		myTimer.start();
		
	}
	
	private function launchHomeNow(e:Event):void
	{
		
		menudb[0].go();
		
	}
	
	private function addBubbles():void
	{
		
		var myTimer:Timer = new Timer(50, 20);
		myTimer.addEventListener('timer', addBubble);

		// Start the timer
		myTimer.start();
		
	}
	
	private function addBubble(e:Event):void
	{
		
		var bubble : Bubble = new Bubble();
		logo_mc.bubbles.addChild(bubble);
		
	}
	
}

}

