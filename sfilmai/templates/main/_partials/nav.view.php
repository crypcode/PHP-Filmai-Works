<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <?php foreach ($nav['actions'] as $id => $navigation):?>
                <?php if ($id != 'dropdown'):?>
                    <li class="nav-item">
                        <a class="nav-link" href ="?page=<?=$id?>"><?=$navigation;?></a>
                    </li>
                <?php endif;?>
            <?php endforeach;?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Veiksmai
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <?php foreach ($nav as $id => $navigation):?>
                        <?php foreach ($navigation as $id => $tab):?>
                            <?php if (is_array($tab)):?>
                                <?php foreach ($tab as $id => $tabs):?>
                                    <a class="dropdown-item" href ="?page=<?=$id?>"><?=$tabs;?></a>
                                <?php endforeach;?>
                            <?php endif;?>
                        <?php endforeach;?>
                    <?php endforeach;?>
                </div>
            </li>
        </ul>
    </div>
</nav>