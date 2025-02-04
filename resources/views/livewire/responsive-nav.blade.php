<div>
    <div class="nav-down relactive">
        <div class="box">
            <a href="/">
                <button><i class="fa fa-home"></i></button>
            </a>
        </div>
        <div class="box">
            <a href="">
                <button><i class="fa-solid fa-add"></i></button>
            </a>
        </div>
        <div class="box">
            <a wire:click="toggleNavSidbar">
                <button><i class="fa fa-bars"></i></button>
            </a>
        </div>
    </div>
    @if($isNavSidbar)
    <div class="sidbar-responsive">
        <h1>Sidbar responsive</h1>
    </div>
    @endif
</div>
