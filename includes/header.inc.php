<header class="mdl-layout__header" id="fireBrick">
    <div class="mdl-layout__header-row">
    <h1 class="mdl-layout-title"><span>CRM</span> Admin</h1>
    
    
    
    <div class="mdl-layout-spacer"></div>
    
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right">
            

            <div > 
            <!--https://codepen.io/anon/pen/GOyKVb-->
                <form id= "demo-2" action="browse-employees.php" method="get">
                 <!--class="mdl-textfield__input mdl-color-text--white" id="fixed-header-drawer-exp"-->
                    <input  type="search" name="ln" placeholder="    Enter last name">
                </form>
            </div>
            
            <label id="tt2" class="material-icons mdl-badge mdl-badge--overlap" data-badge="5">account_box</label>  
            <div class="mdl-tooltip" for="tt2">Messages</div>                     
            
            <label id="tt3" class="material-icons mdl-badge mdl-badge--overlap" data-badge="4">notifications</label> 
            <div class="mdl-tooltip" for="tt3">Notifications</div>      
            
            <a href="logout.php"><label id="tt4" class="material-icons mdl-badge mdl-badge--overlap" >power_settings_new</label></a> 
            <div class="mdl-tooltip" for="tt4">Logout</div>
        
        </div>
    </div>
</header>