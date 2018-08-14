<div class="dropdown-menu" aria-labelledby="language" >
    @foreach (array_keys(config('locale.languages_omenkul')) as $lang)
        @if ($lang != app()->getLocale())
            <div class="dropdown-item">
                <?php if ($lang == 'en') { ?>
                    <a href="{{ '/lang/'.$lang }}" class="dropdown-item"><i class="flag-icon flag-icon-um"></i></a> 
                <?php } else if ($lang == 'ar') { ?>
                    <a href="{{ '/lang/'.$lang }}" class="dropdown-item"><i class="flag-icon flag-icon-sa"></i></a>
                <?php } else { ?>
                    <a href="{{ '/lang/'.$lang }}" class="dropdown-item"><i class="flag-icon flag-icon-{{ $lang }}"></i></a> 
                <?php } ?>                                   
                
            </div>            
        @endif
    @endforeach
</div>
