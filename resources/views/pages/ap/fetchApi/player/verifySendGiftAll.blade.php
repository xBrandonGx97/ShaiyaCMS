<form class="send_gift_verify" id="send_gift_verify">
  <div class="alert alert-danger">
    <i class="fa fa-exclamation-triangle"></i>
    Are you sure you want to send <b>{{$data['gift']->getItemNameFromId($data['postChecks']['itemId'])}}</b> x<b>{{$data['postChecks']['itemCount']}}</b> to all players?
  </div>
  <input name="ItemID" type="hidden" value="{{$data['postChecks']['itemId']}}"/>
  <input name="ItemCount" type="hidden" value="{{$data['postChecks']['itemCount']}}"/>
  <div class="text-center fs_20">
    <button type="button" class="btn btn-sm btn-primary submit_d" id="send_gift_verify_submit">
      <i class="fa fa-check-circle"></i>
      Send Gift
    </button>
  </div>
</form>
