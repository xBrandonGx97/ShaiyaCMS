@if (isset($_POST['submit']))
  @if (empty($data['postChecks']['itemId']))
    {{$data['gift']->setError('ItemID empty')}}
  @elseif (empty($data['postChecks']['itemCount']))
    {{$data['gift']->setError('ItemCount empty.')}}
  @elseif (!is_numeric($data['postChecks']['itemId']))
    {{$data['gift']->setError('ItemID must be a number.')}}
  @elseif (strlen($data['postChecks']['itemId']) > 6)
    {{$data['gift']->setError('ItemID length is too long.')}}
  @elseif (!is_numeric($data['postChecks']['itemCount']))
    {{$data['gift']->setError('ItemCount must be a number.')}}
  @elseif ($data['postChecks']['itemCount'] > 255)
    {{$data['gift']->setError('ItemCount cannot be greater than 255.')}}
  @endif
  @if(count($data['gift']->getErrors())==0)
    {{$data['gift']->setFormComplete()}}
    @include('pages.ap.fetchApi.player.verifySendGiftAll')
  @endif
@endif
@if (count($data['gift']->getErrors()))
  <ul>
    @foreach($data['gift']->getErrors() as $error)
      <li>{{$error}}</li>
    @endforeach
  </ul>
@endif
@if ($data['gift']->getFormComplete() === 0)
<form class="send_gift" id="send_gift">
  <div class="form-group mx-sm-3 mb-2">
    <input type="text" name="ItemID" placeholder="ItemID" class="form-control"/>
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <input type="text" name="ItemCount" placeholder="Amount" class="form-control"/>
  </div>
  <p class="text-center">
    <button type="button" class="btn btn-sm btn-primary submit_c" id="sendGiftModal">
      Verify Gift
      <i class="fas fa-paper-plane"></i>
    </button>
  </p>
</form>
@endif
