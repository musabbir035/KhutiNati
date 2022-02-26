@extends('admin.layout')
@section('title', 'Notifications')
@section('main')
<div class="card">
  <div class="card-header">
    <h4>Notifications</h4>
  </div>
  <div class="card-body">
    <div class="notification-container">
      <a class="notification-item unread" href="http://khutinati.test/admin/orders/1"
        id="47356385-37d5-44fc-bc53-bb9f345534f1">
        <div class="notification-item-title">John placed an order.</div>
        <div class="notification-item-message">Order total: 134.</div>
      </a>
    </div>
  </div>
</div>
@endsection