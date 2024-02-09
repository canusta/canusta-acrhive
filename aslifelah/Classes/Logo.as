/*
* @author Can Usta
*/

package 
{
	
	import flash.display.*;
	import lt.uza.utils.*;
	import caurina.transitions.*;;
	
	public class Logo extends MovieClip
	{
		
		private var global							: Global = Global.getInstance();
		
		public function Logo()
		{
			
			global.logo = this;
			this.alpha=0;
			Tweener.addTween(this, { alpha: 1, time:4, transition:"easeOutExpo"} );
			
		}
		
	}
	
}