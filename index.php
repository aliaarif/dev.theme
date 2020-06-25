<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="ThemeSelect">
<?php //include_once('common/csrf'); ?>
<title>Theme</title>
<link rel="apple-touch-icon" href="images/favicon/apple-touch-icon-152x152.png">
<link rel="shortcut icon" type="image/x-icon" href="images/favicon/favicon-32x32.png">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="vendors/vendors.min.css">
<link rel="stylesheet" type="text/css" href="vendors/animate-css/animate.css">
<link rel="stylesheet" type="text/css" href="css/themes/vertical-menu-nav-dark-template/materialize.css">
<link rel="stylesheet" type="text/css" href="css/themes/vertical-menu-nav-dark-template/style.css">
<link rel="stylesheet" type="text/css" href="css/pages/dashboard-modern.css">
<link rel="stylesheet" type="text/css" href="css/custom/custom.css">
</head>
<body  class="vertical-layout page-header-light vertical-menu-collapsible vertical-menu-nav-dark 2-columns  "  data-open="click" data-menu="vertical-menu-nav-dark" data-col="2-columns">
<div id="app">
<header class="page-topbar" id="header">
<div class="navbar navbar-fixed"> 
<nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-purple-deep-orange gradient-shadow">
<div class="nav-wrapper">
	<ul class="navbar-list right">
	<li><a class="custom-disabled-class waves-effect waves-block waves-light profile-button" href="javascript:;" data-target="profile-dropdown"><span class="material-icons" style="position: relative; top: 5px;">format_indent_increase</span></a></li>
	</ul>
	<ul class="dropdown-content" id="profile-dropdown">
	<li><a class="grey-text text-darken-1 custom-disabled-class" href="javascript:;"><i class="material-icons">person_outline</i>Profile</a></li>
	<li>
	<a class="grey-text text-darken-1 custom-disabled-class" href="javascript:;" data-target="slide-out" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i>Logout</a>
	<form id="logout-form" action="javascript:;" method="POST" style="display: none;">
	</form>
	</li>
	</ul>
	</div>
	</nav>
	</div>
	</header>
	
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light navbar-full sidenav-active-rounded">
<div class="brand-sidebar">
<h1 class="logo-wrapper">
<a class="custom-disabled-class brand-logo darken-1" href="javascript:;">
<img src="images/logo/logo.png" alt="logo" />
<span class="logo-text hide-on-med-and-down">Theme</span><br/>
</a>
<a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
</div>
<ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
<li class="navigation-header"><a class="navigation-header-text">YOUR DASHBOARD </a><i class="navigation-header-icon material-icons">home</i>
</li>

<li class="bold open active">
<a  class="custom-disabled-class collapsible-header waves-effect waves-cyan " href="javascript:;">
<i class="material-icons">account_box</i>
<span class="menu-title" data-i18n="">My Profile</span>
</a>
<div class="collapsible-body">
<ul class="collapsible collapsible-sub" data-collapsible="accordion">
<li><a class="custom-disabled-class  collapsible-body" href="" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Personal Information</span></a>
</li>	
</ul>
</div>
</li>

</ul>
<div class="navigation-background"></div>
<a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="javascript:;" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
<div id="main" >
<div class="breadcrumbs-inline pb-1 row" id="breadcrumbs-wrapper">
 <div class="col s10 m10 l10 breadcrumbs-left">
  <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down">
      Page Title Goes Here...
  </h5>
  <ol class="breadcrumbs mb-0 ">
      <li class="breadcrumb-item">
        <a class="custom-disabled-class" href="javascript:;">Dashboard</a>
    </li>
</ol>
</div>
<div class="col s2 m2 l2"><a class="btn btn-floating dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-target="dropdown1"><i class="material-icons">expand_more</i><i class="material-icons right">arrow_drop_down</i></a>
<ul class="dropdown-content" id="dropdown1" tabindex="0">
<li tabindex="0"><a class="grey-text text-darken-2" href="javascript:;">Profile</a></li>
<li tabindex="0"><a class="grey-text text-darken-2" href="javascript:;">Contacts</a></li>
<li tabindex="0"><a class="grey-text text-darken-2" href="javascript:;">HELP?</a></li>
<li class="divider" tabindex="-1"></li>
<li tabindex="0"><a class="grey-text text-darken-2" 
	href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
</ul>
</div>
</div>
<div class="row mb-4">
<div class="input-field col s12">
<textarea id="query" name="query" class="materialize-textarea"  style="height: 100px;" placeholder="Enter Your Query Here..."></textarea>
<label for="client_instructions">Please provide your query here...</label>
<span class="error"><p id="query_error"></p></span>
</div>
<div class="input-field col s12">
<button style="z-index:-9999;" id="saveQueryBtn" class="waves-effect waves-dark btn btn-sm"
type="submit">Submit</button>
</div>
</div>
<aside id="right-sidebar-nav">
 <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
  <div class="row">
   <div class="slide-out-right-title">
    <div class="col s12 border-bottom-1 pb-0 pt-1">
     <div class="row">
      <div class="col s2 pr-0 center">
       <i class="material-icons vertical-text-middle"><a href="#" class="sidenav-close">clear</a></i>
     </div>
     <div class="col s10 pl-0">
       <ul class="tabs">
        <li class="tab col s4 p-0">
         <a href="#messages" class="active">
          <span>Messages</span>
        </a>
      </li>
      <li class="tab col s4 p-0">
       <a href="#settings">
        <span>Settings</span>
      </a>
    </li>
    <li class="tab col s4 p-0">
     <a href="#activity">
      <span>Activity</span>
    </a>
  </li>
</ul>
</div>
</div>
</div>
</div>
<div class="slide-out-right-body">
  <div id="messages" class="col s12">
   <div class="collection border-none">
    <input class="header-search-input mt-4 mb-2" type="text" name="Search" placeholder="Search Messages" />
    <ul class="collection p-0">
     <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
      <span class="avatar-status avatar-online avatar-50"
      ><img src="images/avatar/avatar-7.png" alt="avatar" />
      <i></i>
    </span>
    <div class="user-content">
     <h6 class="line-height-0">Elizabeth Elliott</h6>
     <p class="medium-small blue-grey-text text-lighten-3 pt-3">Thank you</p>
   </div>
   <span class="secondary-content medium-small">5.00 AM</span>
 </li>
 <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
  <span class="avatar-status avatar-online avatar-50"
  ><img src="images/avatar/avatar-1.png" alt="avatar" />
  <i></i>
</span>
<div class="user-content">
 <h6 class="line-height-0">Mary Adams</h6>
 <p class="medium-small blue-grey-text text-lighten-3 pt-3">Hello Boo</p>
</div>
<span class="secondary-content medium-small">4.14 AM</span>
</li>
<li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
  <span class="avatar-status avatar-off avatar-50"
  ><img src="images/avatar/avatar-2.png" alt="avatar" />
  <i></i>
</span>
<div class="user-content">
 <h6 class="line-height-0">Caleb Richards</h6>
 <p class="medium-small blue-grey-text text-lighten-3 pt-3">Hello Boo</p>
</div>
<span class="secondary-content medium-small">4.14 AM</span>
</li>
<li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
  <span class="avatar-status avatar-online avatar-50"
  ><img src="images/avatar/avatar-3.png" alt="avatar" />
  <i></i>
</span>
<div class="user-content">
 <h6 class="line-height-0">Caleb Richards</h6>
 <p class="medium-small blue-grey-text text-lighten-3 pt-3">Keny !</p>
</div>
<span class="secondary-content medium-small">9.00 PM</span>
</li>
<li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
  <span class="avatar-status avatar-online avatar-50"
  ><img src="images/avatar/avatar-4.png" alt="avatar" />
  <i></i>
</span>
<div class="user-content">
 <h6 class="line-height-0">June Lane</h6>
 <p class="medium-small blue-grey-text text-lighten-3 pt-3">Ohh God</p>
</div>
<span class="secondary-content medium-small">4.14 AM</span>
</li>
<li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
  <span class="avatar-status avatar-off avatar-50"
  ><img src="images/avatar/avatar-5.png" alt="avatar" />
  <i></i>
</span>
<div class="user-content">
 <h6 class="line-height-0">Edward Fletcher</h6>
 <p class="medium-small blue-grey-text text-lighten-3 pt-3">Love you</p>
</div>
<span class="secondary-content medium-small">5.15 PM</span>
</li>
<li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
  <span class="avatar-status avatar-online avatar-50"
  ><img src="images/avatar/avatar-6.png" alt="avatar" />
  <i></i>
</span>
<div class="user-content">
 <h6 class="line-height-0">Crystal Bates</h6>
 <p class="medium-small blue-grey-text text-lighten-3 pt-3">Can we</p>
</div>
<span class="secondary-content medium-small">8.00 AM</span>
</li>
<li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
  <span class="avatar-status avatar-off avatar-50"
  ><img src="images/avatar/avatar-7.png" alt="avatar" />
  <i></i>
</span>
<div class="user-content">
 <h6 class="line-height-0">Nathan Watts</h6>
 <p class="medium-small blue-grey-text text-lighten-3 pt-3">Great!</p>
</div>
<span class="secondary-content medium-small">9.53 PM</span>
</li>
<li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
  <span class="avatar-status avatar-off avatar-50"
  ><img src="images/avatar/avatar-8.png" alt="avatar" />
  <i></i>
</span>
<div class="user-content">
 <h6 class="line-height-0">Willard Wood</h6>
 <p class="medium-small blue-grey-text text-lighten-3 pt-3">Do it</p>
</div>
<span class="secondary-content medium-small">4.20 AM</span>
</li>
<li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
  <span class="avatar-status avatar-online avatar-50"
  ><img src="images/avatar/avatar-1.png" alt="avatar" />
  <i></i>
</span>
<div class="user-content">
 <h6 class="line-height-0">Ronnie Ellis</h6>
 <p class="medium-small blue-grey-text text-lighten-3 pt-3">Got that</p>
</div>
<span class="secondary-content medium-small">5.20 AM</span>
</li>
<li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
  <span class="avatar-status avatar-online avatar-50"
  ><img src="images/avatar/avatar-9.png" alt="avatar" />
  <i></i>
</span>
<div class="user-content">
 <h6 class="line-height-0">Daniel Russell</h6>
 <p class="medium-small blue-grey-text text-lighten-3 pt-3">Thank you</p>
</div>
<span class="secondary-content medium-small">12.00 AM</span>
</li>
<li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
  <span class="avatar-status avatar-off avatar-50"
  ><img src="images/avatar/avatar-10.png" alt="avatar" />
  <i></i>
</span>
<div class="user-content">
 <h6 class="line-height-0">Sarah Graves</h6>
 <p class="medium-small blue-grey-text text-lighten-3 pt-3">Okay you</p>
</div>
<span class="secondary-content medium-small">11.14 PM</span>
</li>
<li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
  <span class="avatar-status avatar-off avatar-50"
  ><img src="images/avatar/avatar-11.png" alt="avatar" />
  <i></i>
</span>
<div class="user-content">
 <h6 class="line-height-0">Andrew Hoffman</h6>
 <p class="medium-small blue-grey-text text-lighten-3 pt-3">Can do</p>
</div>
<span class="secondary-content medium-small">7.30 PM</span>
</li>
<li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
  <span class="avatar-status avatar-online avatar-50"
  ><img src="images/avatar/avatar-12.png" alt="avatar" />
  <i></i>
</span>
<div class="user-content">
 <h6 class="line-height-0">Camila Lynch</h6>
 <p class="medium-small blue-grey-text text-lighten-3 pt-3">Leave it</p>
</div>
<span class="secondary-content medium-small">2.00 PM</span>
</li>
</ul>
</div>
</div>
<div id="settings" class="col s12">
 <p class="mt-8 mb-0 ml-5 font-weight-900">GENERAL SETTINGS</p>
 <ul class="collection border-none">
  <li class="collection-item border-none mt-3">
   <div class="m-0">
    <span>Notifications</span>
    <div class="switch right">
     <label>
      <input checked type="checkbox" />
      <span class="lever"></span>
    </label>
  </div>
</div>
</li>
<li class="collection-item border-none mt-3">
 <div class="m-0">
  <span>Show recent activity</span>
  <div class="switch right">
   <label>
    <input type="checkbox" />
    <span class="lever"></span>
  </label>
</div>
</div>
</li>
<li class="collection-item border-none mt-3">
 <div class="m-0">
  <span>Show recent activity</span>
  <div class="switch right">
   <label>
    <input type="checkbox" />
    <span class="lever"></span>
  </label>
</div>
</div>
</li>
<li class="collection-item border-none mt-3">
 <div class="m-0">
  <span>Show Task statistics</span>
  <div class="switch right">
   <label>
    <input type="checkbox" />
    <span class="lever"></span>
  </label>
</div>
</div>
</li>
<li class="collection-item border-none mt-3">
 <div class="m-0">
  <span>Show your emails</span>
  <div class="switch right">
   <label>
    <input type="checkbox" />
    <span class="lever"></span>
  </label>
</div>
</div>
</li>
<li class="collection-item border-none mt-3">
 <div class="m-0">
  <span>Email Notifications</span>
  <div class="switch right">
   <label>
    <input checked type="checkbox" />
    <span class="lever"></span>
  </label>
</div>
</div>
</li>
</ul>
<p class="mt-8 mb-0 ml-5 font-weight-900">SYSTEM SETTINGS</p>
<ul class="collection border-none">
  <li class="collection-item border-none mt-3">
   <div class="m-0">
    <span>System Logs</span>
    <div class="switch right">
     <label>
      <input type="checkbox" />
      <span class="lever"></span>
    </label>
  </div>
</div>
</li>
<li class="collection-item border-none mt-3">
 <div class="m-0">
  <span>Error Reporting</span>
  <div class="switch right">
   <label>
    <input type="checkbox" />
    <span class="lever"></span>
  </label>
</div>
</div>
</li>
<li class="collection-item border-none mt-3">
 <div class="m-0">
  <span>Applications Logs</span>
  <div class="switch right">
   <label>
    <input checked type="checkbox" />
    <span class="lever"></span>
  </label>
</div>
</div>
</li>
<li class="collection-item border-none mt-3">
 <div class="m-0">
  <span>Backup Servers</span>
  <div class="switch right">
   <label>
    <input type="checkbox" />
    <span class="lever"></span>
  </label>
</div>
</div>
</li>
<li class="collection-item border-none mt-3">
 <div class="m-0">
  <span>Audit Logs</span>
  <div class="switch right">
   <label>
    <input type="checkbox" />
    <span class="lever"></span>
  </label>
</div>
</div>
</li>
</ul>
</div>
<div id="activity" class="col s12">
 <div class="activity">
  <p class="mt-5 mb-0 ml-5 font-weight-900">SYSTEM LOGS</p>
  <ul class="collection with-header">
   <li class="collection-item">
    <div class="font-weight-900">
     Homepage mockup design <span class="secondary-content">Just now</span>
   </div>
   <p class="mt-0 mb-2">Melissa liked your activity.</p>
   <span class="new badge amber" data-badge-caption="Important"> </span>
 </li>
 <li class="collection-item">
  <div class="font-weight-900">
   Melissa liked your activity Drinks. <span class="secondary-content">10 mins</span>
 </div>
 <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
 <span class="new badge light-green" data-badge-caption="Resolved"></span>
</li>
<li class="collection-item">
  <div class="font-weight-900">
   12 new users registered <span class="secondary-content">30 mins</span>
 </div>
 <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
</li>
<li class="collection-item">
  <div class="font-weight-900">
   Tina is attending your activity <span class="secondary-content">2 hrs</span>
 </div>
 <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
</li>
<li class="collection-item">
  <div class="font-weight-900">
   Josh is now following you <span class="secondary-content">5 hrs</span>
 </div>
 <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
 <span class="new badge red" data-badge-caption="Pending"></span>
</li>
</ul>
<p class="mt-5 mb-0 ml-5 font-weight-900">APPLICATIONS LOGS</p>
<ul class="collection with-header">
 <li class="collection-item">
  <div class="font-weight-900">
   New order received urgent <span class="secondary-content">Just now</span>
 </div>
 <p class="mt-0 mb-2">Melissa liked your activity.</p>
</li>
<li class="collection-item">
  <div class="font-weight-900">System shutdown. <span class="secondary-content">5 min</span></div>
  <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
  <span class="new badge blue" data-badge-caption="Urgent"> </span>
</li>
<li class="collection-item">
  <div class="font-weight-900">
   Database overloaded 89% <span class="secondary-content">20 min</span>
 </div>
 <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
</li>
</ul>
<p class="mt-5 mb-0 ml-5 font-weight-900">SERVER LOGS</p>
<ul class="collection with-header">
 <li class="collection-item">
  <div class="font-weight-900">System error <span class="secondary-content">10 min</span></div>
  <p class="mt-0 mb-2">Melissa liked your activity.</p>
</li>
<li class="collection-item">
  <div class="font-weight-900">
   Production server down. <span class="secondary-content">1 hrs</span>
 </div>
 <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
 <span class="new badge blue" data-badge-caption="Urgent"></span>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>

<!-- Slide Out Chat -->
<ul id="slide-out-chat" class="sidenav slide-out-right-sidenav-chat">
  <li class="center-align pt-2 pb-2 sidenav-close chat-head">
   <a href="#!"><i class="material-icons mr-0">chevron_left</i>Elizabeth Elliott</a>
 </li>
 <li class="chat-body">
   <ul class="collection">
    <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
     <span class="avatar-status avatar-online avatar-50"
     ><img src="images/avatar/avatar-7.png" alt="avatar" />
   </span>
   <div class="user-content speech-bubble">
    <p class="medium-small">hello!</p>
  </div>
</li>
<li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
 <div class="user-content speech-bubble-right">
  <p class="medium-small">How can we help? We're here for you!</p>
</div>
</li>
<li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
 <span class="avatar-status avatar-online avatar-50"
 ><img src="images/avatar/avatar-7.png" alt="avatar" />
</span>
<div class="user-content speech-bubble">
  <p class="medium-small">I am looking for the best admin template.?</p>
</div>
</li>
<li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
 <div class="user-content speech-bubble-right">
  <p class="medium-small">Materialize admin is the responsive materializecss admin template.</p>
</div>
</li>

<li class="collection-item display-grid width-100 center-align">
 <p>8:20 a.m.</p>
</li>

<li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
 <span class="avatar-status avatar-online avatar-50"
 ><img src="images/avatar/avatar-7.png" alt="avatar" />
</span>
<div class="user-content speech-bubble">
  <p class="medium-small">Ohh! very nice</p>
</div>
</li>
<li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
 <div class="user-content speech-bubble-right">
  <p class="medium-small">Thank you.</p>
</div>
</li>
<li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
 <span class="avatar-status avatar-online avatar-50"
 ><img src="images/avatar/avatar-7.png" alt="avatar" />
</span>
<div class="user-content speech-bubble">
  <p class="medium-small">How can I purchase it?</p>
</div>
</li>

<li class="collection-item display-grid width-100 center-align">
 <p>9:00 a.m.</p>
</li>

<li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
 <div class="user-content speech-bubble-right">
  <p class="medium-small">From ThemeForest.</p>
</div>
</li>
<li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
 <div class="user-content speech-bubble-right">
  <p class="medium-small">Only $24</p>
</div>
</li>
<li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
 <span class="avatar-status avatar-online avatar-50"
 ><img src="images/avatar/avatar-7.png" alt="avatar" />
</span>
<div class="user-content speech-bubble">
  <p class="medium-small">Ohh! Thank you.</p>
</div>
</li>
<li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
 <span class="avatar-status avatar-online avatar-50"
 ><img src="images/avatar/avatar-7.png" alt="avatar" />
</span>
<div class="user-content speech-bubble">
  <p class="medium-small">I will purchase it for sure.</p>
</div>
</li>
<li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
 <div class="user-content speech-bubble-right">
  <p class="medium-small">Great, Feel free to get in touch on</p>
</div>
</li>
<li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
 <div class="user-content speech-bubble-right">
  <p class="medium-small">https://pixinvent.ticksy.com/</p>
</div>
</li>
</ul>
</li>
<li class="center-align chat-footer">
 <form class="col s12" onsubmit="slide_out_chat()" action="javascript:void(0);">
  <div class="input-field">
   <input id="icon_prefix" type="text" class="search" />
   <label for="icon_prefix">Type here..</label>
   <a onclick="slide_out_chat()"><i class="material-icons prefix">send</i></a>
 </div>
</form>
</li>
</ul>
</aside>
</div>
<!-- Theme Customizer -->

<!-- <a
href="#"
data-target="theme-cutomizer-out"
class="btn btn-customizer pink accent-2 white-text sidenav-trigger theme-cutomizer-trigger"
><i class="material-icons">settings</i></a
> -->

<div id="theme-cutomizer-out" class="theme-cutomizer  sidenav row">
<div class="col s12">
<a class="sidenav-close" href="#!"><i class="material-icons">close</i></a>
<h5 class="theme-cutomizer-title">Theme Customizer</h5>
<p class="medium-small">Customize & Preview in Real Time</p>
<div class="menu-options">
<h6 class="mt-6">Menu Options</h6>
<hr class="customize-devider" />
<div class="menu-options-form row">
<div class="input-field col s12 menu-color mb-0">
<p class="mt-0">Menu Color</p>
<div class="gradient-color center-align">
<span class="menu-color-option gradient-45deg-indigo-blue" data-color="gradient-45deg-indigo-blue"></span>
<span
class="menu-color-option gradient-45deg-purple-deep-orange"
data-color="gradient-45deg-purple-deep-orange"
></span>
<span
class="menu-color-option gradient-45deg-light-blue-cyan"
data-color="gradient-45deg-light-blue-cyan"
></span>
<span
class="menu-color-option gradient-45deg-purple-amber"
data-color="gradient-45deg-purple-amber"
></span>
<span
class="menu-color-option gradient-45deg-purple-deep-purple"
data-color="gradient-45deg-purple-deep-purple"
></span>
<span
class="menu-color-option gradient-45deg-deep-orange-orange"
data-color="gradient-45deg-deep-orange-orange"
></span>
<span class="menu-color-option gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
<span
class="menu-color-option gradient-45deg-indigo-light-blue"
data-color="gradient-45deg-indigo-light-blue"
></span>
<span class="menu-color-option gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
</div>
<div class="solid-color center-align">
<span class="menu-color-option red" data-color="red"></span>
<span class="menu-color-option purple" data-color="purple"></span>
<span class="menu-color-option pink" data-color="pink"></span>
<span class="menu-color-option deep-purple" data-color="deep-purple"></span>
<span class="menu-color-option cyan" data-color="cyan"></span>
<span class="menu-color-option teal" data-color="teal"></span>
<span class="menu-color-option light-blue" data-color="light-blue"></span>
<span class="menu-color-option amber darken-3" data-color="amber darken-3"></span>
<span class="menu-color-option brown darken-2" data-color="brown darken-2"></span>
</div>
</div>
<div class="input-field col s12 menu-bg-color mb-0">
<p class="mt-0">Menu Background Color</p>
<div class="gradient-color center-align">
<span
class="menu-bg-color-option gradient-45deg-indigo-blue"
data-color="gradient-45deg-indigo-blue"
></span>
<span
class="menu-bg-color-option gradient-45deg-purple-deep-orange"
data-color="gradient-45deg-purple-deep-orange"
></span>
<span
class="menu-bg-color-option gradient-45deg-light-blue-cyan"
data-color="gradient-45deg-light-blue-cyan"
></span>
<span
class="menu-bg-color-option gradient-45deg-purple-amber"
data-color="gradient-45deg-purple-amber"
></span>
<span
class="menu-bg-color-option gradient-45deg-purple-deep-purple"
data-color="gradient-45deg-purple-deep-purple"
></span>
<span
class="menu-bg-color-option gradient-45deg-deep-orange-orange"
data-color="gradient-45deg-deep-orange-orange"
></span>
<span class="menu-bg-color-option gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
<span
class="menu-bg-color-option gradient-45deg-indigo-light-blue"
data-color="gradient-45deg-indigo-light-blue"
></span>
<span class="menu-bg-color-option gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
</div>
<div class="solid-color center-align">
<span class="menu-bg-color-option red" data-color="red"></span>
<span class="menu-bg-color-option purple" data-color="purple"></span>
<span class="menu-bg-color-option pink" data-color="pink"></span>
<span class="menu-bg-color-option deep-purple" data-color="deep-purple"></span>
<span class="menu-bg-color-option cyan" data-color="cyan"></span>
<span class="menu-bg-color-option teal" data-color="teal"></span>
<span class="menu-bg-color-option light-blue" data-color="light-blue"></span>
<span class="menu-bg-color-option amber darken-3" data-color="amber darken-3"></span>
<span class="menu-bg-color-option brown darken-2" data-color="brown darken-2"></span>
</div>
</div>
<div class="input-field col s12">
<div class="switch">
Menu Dark
<label class="float-right"
><input class="menu-dark-checkbox" type="checkbox"/> <span class="lever ml-0"></span
></label>
</div>
</div>
<div class="input-field col s12">
<div class="switch">
Menu Collapsed
<label class="float-right"
><input class="menu-collapsed-checkbox" type="checkbox"/> <span class="lever ml-0"></span
></label>
</div>
</div>
<div class="input-field col s12">
<div class="switch">
<p class="mt-0">Menu Selection</p>
<label>
<input
class="menu-selection-radio with-gap"
value="sidenav-active-square"
name="menu-selection"
type="radio"
/>
<span>Square</span>
</label>
<label>
<input
class="menu-selection-radio with-gap"
value="sidenav-active-rounded"
name="menu-selection"
type="radio"
/>
<span>Rounded</span>
</label>
<label>
<input class="menu-selection-radio with-gap" value="" name="menu-selection" type="radio" />
<span>Normal</span>
</label>
</div>
</div>
</div>
</div>
<h6 class="mt-6">Navbar Options</h6>
<hr class="customize-devider" />
<div class="navbar-options row">
<div class="input-field col s12 navbar-color mb-0">
<p class="mt-0">Navbar Color</p>
<div class="gradient-color center-align">
<span class="navbar-color-option gradient-45deg-indigo-blue" data-color="gradient-45deg-indigo-blue"></span>
<span
class="navbar-color-option gradient-45deg-purple-deep-orange"
data-color="gradient-45deg-purple-deep-orange"
></span>
<span
class="navbar-color-option gradient-45deg-light-blue-cyan"
data-color="gradient-45deg-light-blue-cyan"
></span>
<span class="navbar-color-option gradient-45deg-purple-amber" data-color="gradient-45deg-purple-amber"></span>
<span
class="navbar-color-option gradient-45deg-purple-deep-purple"
data-color="gradient-45deg-purple-deep-purple"
></span>
<span
class="navbar-color-option gradient-45deg-deep-orange-orange"
data-color="gradient-45deg-deep-orange-orange"
></span>
<span class="navbar-color-option gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
<span
class="navbar-color-option gradient-45deg-indigo-light-blue"
data-color="gradient-45deg-indigo-light-blue"
></span>
<span class="navbar-color-option gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
</div>
<div class="solid-color center-align">
<span class="navbar-color-option red" data-color="red"></span>
<span class="navbar-color-option purple" data-color="purple"></span>
<span class="navbar-color-option pink" data-color="pink"></span>
<span class="navbar-color-option deep-purple" data-color="deep-purple"></span>
<span class="navbar-color-option cyan" data-color="cyan"></span>
<span class="navbar-color-option teal" data-color="teal"></span>
<span class="navbar-color-option light-blue" data-color="light-blue"></span>
<span class="navbar-color-option amber darken-3" data-color="amber darken-3"></span>
<span class="navbar-color-option brown darken-2" data-color="brown darken-2"></span>
</div>
</div>
<div class="input-field col s12">
<div class="switch">
Navbar Dark
<label class="float-right"
><input class="navbar-dark-checkbox" type="checkbox"/> <span class="lever ml-0"></span
></label>
</div>
</div>
<div class="input-field col s12">
<div class="switch">
Navbar Fixed
<label class="float-right"
><input class="navbar-fixed-checkbox" type="checkbox" checked/> <span class="lever ml-0"></span
></label>
</div>
</div>
</div>
<h6 class="mt-6">Footer Options</h6>
<hr class="customize-devider" />
<div class="navbar-options row">
<div class="input-field col s12">
<div class="switch">
Footer Dark
<label class="float-right"
><input class="footer-dark-checkbox" type="checkbox"/> <span class="lever ml-0"></span
></label>
</div>
</div>
<div class="input-field col s12">
<div class="switch">
Footer Fixed
<label class="float-right"
><input class="footer-fixed-checkbox" type="checkbox"/> <span class="lever ml-0"></span
></label>
</div>
</div>
</div>
</div>
</div>
<!--/ Theme Customizer -->

<!-- <a
href="javascript:;"
target="_blank"
class="btn btn-buy-now gradient-45deg-indigo-purple gradient-shadow white-text tooltipped buy-now-animated tada"
data-position="left"
data-tooltip="Buy Now!"
><i class="material-icons">add_shopping_cart</i></a
> -->

<!-- BEGIN: Footer-->
<footer class="page-footer footer footer-dark gradient-45deg-purple-deep-orange gradient-shadow navbar-border navbar-shadow footer-fixed">
<div class="footer-copyright">
<div class="container"><span class="right hide-on-small-only">&copy; 2020 <a href="javascript:;">ArabEasy</a> All rights reserved.</span></div>
</div>
</footer>
</div>
<!-- <script src="js/app.js" type="text/javascript"></script> -->
<script src="js/vendors.min.js" type="text/javascript"></script>
<script src="js/plugins.js" type="text/javascript"></script>
<script src="js/scripts/customizer.js" type="text/javascript"></script>
<!-- <script src="js/scripts/intro.js" type="text/javascript"></script>
<script src="js/axios.min.js"></script> -->
</body>
</html>