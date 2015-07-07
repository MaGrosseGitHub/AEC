<?php
class Menu{	

	public $menu; 

	function __construct($role, $id = 0) {
		$menu = $this->loadMenu($role);
		$this->menu = $this->getMenu($menu, $id);
		return $this->menu;
	}

	private function loadMenu($role) {
		// $menu = new DomDocument();
		$menupath = ROOT.DS.'view'.DS.'layout'.DS.$role.'.xml';
		$menu = simplexml_load_file($menupath);
		// $menu = $menu->load();		
		return $menu;
	}

	public function getMenu($menu) {	
		return $this->prepareMenu($menu);
	}

	private function prepareMenu($menuXml, $submenu = false, $parent = null){	      	 
      	$getMenu = "";
		foreach ($menuXml as $upperMenuData => $menu) {
			// debug($upperMenuData);
			// debug($menu->attributes());
			// debug($menu);
			ob_start();
			$before = '<p><a href="#" id="trigger'.$menu->attributes()['name'].'" class="menu-trigger">Open/Close Menu</a></p>
			<!-- Push Wrapper -->
		      <div class="'.$menu->attributes()['icon'].'"></div>
		      <div class="mp-pusher" id="mp-pusher">

		        <!-- mp-menu -->
		        <nav id="mp-menu'.$menu->attributes()['name'].'" class="mp-menu">
		          <div class="mp-level">
		            <h2 class="icon icon-world">All Categories</h2>
		            <ul>';
	        echo $before;
			$this->prepareSubMenu($menu, $submenu, $parent);
			$after = '
		          </ul>
		          <!-- mp-level -->
		          </div>
		        </nav>
		        <!-- /mp-menu -->
		      </div>
		      <!-- /pusher -->
		      <script>
			    new mlPushMenu( document.getElementById( "mp-menu'.$menu->attributes()['name'].'" ), document.getElementById( "trigger'.$menu->attributes()['name'].'" ) );

    			$(document).ready(function() {
					console.log($("#mp-menu'.$menu->attributes()['name'].'").closest("div#mp-pusher").height());
					$("#mp-menu'.$menu->attributes()['name'].'").closest("div#mp-pusher").hide().css("top", "300px");
					$("#trigger'.$menu->attributes()['name'].'").click(function(){
						$("#mp-menu'.$menu->attributes()['name'].'").closest("div#mp-pusher").show();
					});
					console.log($("#mp-menu'.$menu->attributes()['name'].'").closest("div#mp-pusher").height());
    			});
			   </script>';
	      	echo $after;
			$getMenu .= ob_get_clean();
		}
      	return $getMenu;
	}

	private function prepareSubMenu($menuXml, $submenu = false, $parent = null) {
		//ajouter tag icon
		$newul = false;
		if($parent == null)
			$parent = "";
		if($submenu) {
			echo '<ul>
						<li class="icon icon-arrow-left">';
			if($parent != null) {
				echo '
							<a class="'.$parent['icon'].'" href="#">'.$parent['name'].'</a>';
			}
			echo '
								<div class="mp-level">';
		}
		foreach ($menuXml as $submenuData => $links) {
			if($submenuData == "link") {
				echo '<li><a class="'.$links->icon.'" href = "'.$links->href.'">'.$links->title.'</a></li>'; 
			} elseif($submenuData == "name") {
				echo '<h2 class="'.$menuXml->$submenuData->icon.'">'.$menuXml->$submenuData->title.'</h2>';
				echo '<a class="mp-back" href="#">back</a>';
				echo '<ul>';
				$newUl = true;
				$parent = $menuXml->$submenuData;
			}else {
				// debug($links[0]->attributes()['icon']);
				$this->prepareSubMenu($links, true, $links[0]->attributes());
			}
		}
		if($newul){
			echo "</ul>";
			$newul = false;
		}
		if($submenu) {
			echo "		</div>
					</li>
				</ul>	";
		}
    }

    protected function deleteMenu() {
    	
    }

}