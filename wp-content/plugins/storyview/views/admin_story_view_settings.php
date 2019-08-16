<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}

$active_tab = "general";

if(isset($_GET["tab"])){
  $active_tab = $_GET["tab"];

  switch($active_tab){
    case "general":
      $active_tab = "general";
      break;

    case "amp_settings":
      $active_tab = "amp_settings";
      break;

    case "share_settings":
      $active_tab = "share_settings";
      break;

    case "button_designer":
      $active_tab = "button_designer";
      break;

    default:
      $active_tab = "general";
      break;
  }
}

?>
<div class="wrap">
  <h1>⚡ Story View Settings</h1>

  <div class="nav-tabs">
    <h2 class="nav-tab-wrapper">
      <a href="admin.php?page=storyview_settings&tab=general" class="nav-tab <?php echo ($active_tab == "general") ? 'nav-tab-active' : ''; ?>">General</a>

      <a href="admin.php?page=storyview_settings&tab=amp_settings" class="nav-tab <?php echo ($active_tab == "amp_settings") ? 'nav-tab-active' : ''; ?>">AMP Settings</a>

      <a href="admin.php?page=storyview_settings&tab=share_settings" class="nav-tab <?php echo ($active_tab == "share_settings") ? 'nav-tab-active' : ''; ?>">Share Settings</a>

      <a href="admin.php?page=storyview_settings&tab=button_designer" class="nav-tab <?php echo ($active_tab == "button_designer") ? 'nav-tab-active' : ''; ?>">Button Designer</a>
    </h2>
  </div>

  <?php
  settings_errors();
  
  if($active_tab != "button_designer"){
    ?>
    <form method="post" action="options.php">
    <?php
  }
    switch($active_tab){
      case "general":
        include("admin_settings_general.php");
        break;
      
      case "amp_settings":
        include("admin_settings_amp_settings.php");
        break;
      
      case "share_settings":
        include("admin_settings_share_settings.php");
        break;
      

      case "button_designer":
        include("admin_settings_button_designer.php");
        break;
      
      default:
        /**
         * Display form to edit general settings
         */
        break;
    }
  
  if($active_tab != "button_designer"){
    ?>
    </form>
    <?php
  }
  ?>
</div>