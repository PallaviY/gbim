<header class="header header_style_01">
    <nav class="megamenu navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url() ?>"><img src="images/logos/logo-hosting.png" alt="image"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a class="<?php activate_menu('home');?>" href="<?php echo base_url() ?>">Home</a></li>
                    <li><a class="<?php activate_menu('features');?>" href="<?php echo base_url() ?>features">Features </a></li>
                    <li><a class="<?php activate_menu('domain');?>" href="<?php echo base_url() ?>domain">Domain</a></li>
                    <li><a class="<?php activate_menu('hosting');?>" href="<?php echo base_url() ?>hosting">Hosting</a></li>
                    <li><a class="<?php activate_menu('pricing');?>" href="<?php echo base_url() ?>pricing">Pricing</a></li>
                    <li><a class="<?php activate_menu('contact');?>" href="<?php echo base_url() ?>contact">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="btn-light btn-radius btn-brd log" href="#" data-toggle="modal" data-target="#login"><i class="flaticon-padlock"></i> Customer Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>