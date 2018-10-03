<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderPlaced extends Notification
{
    use Queueable;
    public $order;
    public $invoice;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order, $invoice)
    {
        $this->order = $order;
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Your order#'. $this->order->id .' is in process')
                    ->line('Thanks for your order')
                    ->action('Track', url('/'))
                    ->line('Thank you for using our application!')
                    ->attach(public_path().'/orders/invoices/invoice'.$this->order->id.'.pdf', [
                        'as' => 'Order#'.$this->order->id.'invoice.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }


    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content('Your SMS message content')
            ->from('18702703909');
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
