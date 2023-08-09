@props(['category'])

<a href="/?category={{ $category->id }}"
   class="category-link"
   style="font-size: 10px; text-decoration: none;"
>{{ $category->name }}</a>
