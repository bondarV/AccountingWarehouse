<?php

namespace App\Notifications;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PurchaseCreatedNotification extends Notification
{
    use Queueable;

    protected $purchase;

    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $product = $this->purchase->product;
        $warehouse = $this->purchase->warehouse;
        return (new MailMessage)
        ->subject('Your Purchase Was Successful')
        ->line('Thank you for your purchase!')
        ->line('Purchase details: ')
        ->line('Product(-s/es): ' . $product->name)
        ->
        line('Quantity: ' . $this->purchase->quantity)
        ->line('Warehouse: ' . $warehouse->title);
    }
}
