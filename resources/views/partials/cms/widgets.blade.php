<div class="col-lg-4 nk-sidebar-sticky-parent" style="">
    <aside class="nk-sidebar nk-sidebar-left nk-sidebar-sticky">
        <div class="" style="">
            <div class="luneth-sidebar-item">
                <div class="nk-box-1 bg-dark-2">
                        @if(count($data['widget']) > 0)
                            @foreach($data['widget'] as $widget)
                                @if($widget->Enabled==='1')
                                    <h4>{{$widget->Title}}</h4>
                                    <div>
                                        @require($GLOBALS['config']['WIDGETDIR'].$widget->Name.'/php/script.blade.php')
                                    </div>
                                    <div class="nk-gap-2"></div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </aside>
</div>
