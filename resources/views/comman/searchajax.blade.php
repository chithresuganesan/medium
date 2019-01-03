
<div style="z-index:999" class="list-group">
  @forelse ($filters as $key => $filter)
  <a href="{{ route('post.viewpost', ['post' =>$filter ]) }}" class="list-group-item list-group-item-action ">
    {{ $filter->title }}
  </a>
@empty
  <a href="#" class="list-group-item list-group-item-action bg-secondary text-white">
    No Data Find
  </a>
@endforelse
</div>
