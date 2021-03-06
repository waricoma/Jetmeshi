@php
    $post = $post ?? '';
/**
 * return value for old
 * @return string
 * @param array $name
 **/
        if($post != '') {
          $post_tags = $post->tags()->get(); //array of id on tags table
        }
@endphp
{{-- 実装 --}}
<label for="tag" class="d-block">
    <i class="fas fa-tags"></i>{{ __(' タグ ') }}
</label>
<div id="tag_container" class="row">
    <div id="tag_group1" class="col-6 form-group justify-content-between">
        @for ( $i = 0; $i < floor( count($tags) / 2 ); $i++ )
        <div class="custom-control custom-checkbox">
            <input type="checkbox" id="{{ 'customCheck'.$i }}" class="custom-control-input" name="tags[]"
                value="{{ $i+1 }}" @if (is_array($post_tags[$i]['id'] ?? '' ) && in_array("$i", $post_tags[$i]['id']
                ?? '' , true)) checked @endif>
            <label class="custom-control-label" for="{{ 'customCheck'.$i }}">{{ $tags[$i]['name'] }}</label>
        </div>
        @endfor
    </div>


    <div id="tag_group2" class="col-5 form-group justify-content-between">
        @for ( $l = count($tags) - floor(count($tags) / 2), $i = $l; $i < floor(count($tags)); $i++ )
        <div class="custom-control custom-checkbox">
            <input type="checkbox" id="{{ 'customCheck' . $i }}" class="custom-control-input" name="tags[]"
                value="{{ $i+1 }}">
            <label class="custom-control-label" for="{{ 'customCheck'. $i }}">{{ $tags[$i]['name'] }}</label>
        </div>
        @endfor
    </div>
</div>

