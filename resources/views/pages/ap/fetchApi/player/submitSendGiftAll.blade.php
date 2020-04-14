{{$data['gift']->sendMassGift()}}
@if ($data['gift']->getGiftState() === true)
  <div class="alert alert-success">
    <i class="fas fa-check-circle"></i>
    Gift (<b>{{$data['gift']->getItemNameFromId($data['gift']->itemId)}}</b> x<b>{{$data['gift']->itemCount}}</b>) sucessfully delivered to all players<br>
  </div>
@else
  <div class="alert alert-danger">
    <i class="fa fa-exclamation-triangle"></i>
    Gift failed to send.
  </div>
@endif
