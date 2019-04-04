@if($element->parts()->isNotEmpty())
  <div class="row">
    <div class="col-4">
      <h5>Partes</h5>
      <div class="list-group" id="list-tab-parts" role="tablist">
        @foreach ($element->parts() as $part)
          <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#part-{{$part->id}}" role="tab" aria-controls="parts">
            <strong>{{ $part->name }}</strong>
          </a>
        @endforeach
      </div>
    </div>
    <div class="col-8">
      <div class="tab-content" id="nav-tabContent">
        <h5>Definiciones de las partes</h5>
        @foreach ($element->parts() as $part)
          <div class="tab-pane fade" id="part-{{$part->id}}" role="tabpanel" aria-labelledby="list-parts-list">
            <ul class="list-group list-group-flush">
              @foreach ($part->definitions as $definition)
                <li class="list-group-item">
                  {{ $definition->definition }}
                </li>
              @endforeach
            </ul>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif
