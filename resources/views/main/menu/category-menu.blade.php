@foreach ($categories as $category)
  <li class="nav-item category-item">
    @if(!$category->children || count($category->children) == 0)
    <a href="{{ route('categories.show', ['slug' => $category->slug]) }}" class="nav-link">
      {{ $category->name }}
    </a>
    @else
    <a href="#" class="nav-link" data-cartgory-dropdown>
      {{ $category->name }}
      <i class="fa-solid fa-angle-right right"></i>
    </a>
    <ul class="category-sub-menu">
      @include('main.menu.category-menu', ['categories' => $category->children])
    </ul>
    @endif
  </li>
@endforeach
