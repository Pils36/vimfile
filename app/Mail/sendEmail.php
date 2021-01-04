<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($thisMail)
    {
        $this->mail = $thisMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->mail->purpose == "VIM File - Contact Us"){
        return $this->subject($this->mail->purpose)->view('mails.contactus')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "Admin Team - Contact"){
        return $this->subject($this->mail->purpose)->view('mails.contactadmin')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "VIM File - Password Change"){
        return $this->subject($this->mail->purpose)->view('mails.passwordchange')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "VIM File - Account Approval"){
        return $this->subject($this->mail->purpose)->view('mails.approval')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "VIM File - Payment Acknowledged"){
        return $this->subject($this->mail->purpose)->view('mails.paymentapproved')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "VIM File - Account Declined"){
        return $this->subject($this->mail->purpose)->view('mails.decline')
                    ->with('maildata', $this->mail);
        }

        elseif($this->mail->purpose == "VIM File - New Message"){
        return $this->subject($this->mail->purpose)->view('mails.newmessage')
                    ->with('maildata', $this->mail);
        }

        elseif($this->mail->purpose == "Vehicle maintenance"){
        return $this->subject($this->mail->purpose)->view('mails.maintenancejob')
                    ->with('maildata', $this->mail);
        }

        elseif($this->mail->purpose == "VIM File - Additional Email Update"){
        return $this->subject($this->mail->purpose)->view('mails.addemail')
                    ->with('maildata', $this->mail);
        }

        elseif($this->mail->purpose == "VIM File - Reminder Settings Update"){
        return $this->subject($this->mail->purpose)->view('mails.rememail')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "VIM File - New Vehicle Registration"){
        return $this->subject($this->mail->purpose)->view('mails.newvehicle')
                    ->with('maildata', $this->mail);
        }

        elseif($this->mail->purpose == "VIM File - New Maintenace Record"){
        return $this->subject($this->mail->purpose)->view('mails.newmaintenance')
                    ->with('maildata', $this->mail);
        }

        elseif($this->mail->purpose == "VIM FILE -You can now do vehicle maintenance, wherever, whenever"){
        return $this->subject($this->mail->purpose)->view('mails.inviteReg')
                    ->with('maildata', $this->mail);
        }

        elseif($this->mail->purpose == "VIM File - Estimate Process"){
        return $this->subject($this->mail->purpose)->view('mails.estimatemail')
                    ->with('maildata', $this->mail);
        }

        elseif($this->mail->purpose == "VIM File - Payment Receipt"){
        return $this->subject($this->mail->purpose)->view('mails.paymentreceipt')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "VIM File - Purchase Order"){
        return $this->subject($this->mail->purpose)->view('mails.estimatemail')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "VIM File - Vendor Invoice"){
        return $this->subject($this->mail->purpose)->view('mails.vendorsmail')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "VIM File - Labour Payment Invoice"){
        return $this->subject($this->mail->purpose)->view('mails.labourpaymentinvoice')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "VIM File - Search Appearance"){
        return $this->subject($this->mail->purpose)->view('mails.searchappearance')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "VIM File - A client wants to book an appointment with you"){
        return $this->subject($this->mail->purpose)->view('mails.bookappointment')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "VIM File - Book an Appointment"){
        return $this->subject($this->mail->purpose)->view('mails.userbookappointment')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "VIM File - Support Ticket Created"){
        return $this->subject($this->mail->purpose)->view('mails.supportticket')
                    ->with('maildata', $this->mail);
        }

        elseif($this->mail->purpose == "VIM FILE Admin- Client Redeemed points"){
        return $this->subject($this->mail->purpose)->view('mails.adminredeem')
                    ->with('maildata', $this->mail);
        }

        elseif($this->mail->purpose == "VIM FILE - Redeem your points today"){
        return $this->subject($this->mail->purpose)->view('mails.clientredeem')
                    ->with('maildata', $this->mail);
        }

        elseif($this->mail->purpose == "Register a Vehicle and start tracking all maintenance activities"){
        return $this->subject($this->mail->purpose)->view('mails.recordvehicle')
                    ->with('maildata', $this->mail);
        }

        elseif($this->mail->purpose == "We have made it easier to track vehicle maintenance activities"){
        return $this->subject($this->mail->purpose)->view('mails.recordmaintenance')
                    ->with('maildata', $this->mail);
        }

        elseif($this->mail->purpose == "1-Year Vehicle Oil Change is on Us"){
        return $this->subject($this->mail->purpose)->view('mails.uploadcontacts')
                    ->with('maildata', $this->mail);
        }

        elseif($this->mail->purpose == "Your Vehicle Information is Missing"){
        return $this->subject($this->mail->purpose)->view('mails.infomissing')
                    ->with('maildata', $this->mail);
        }

        elseif($this->mail->purpose == "This Month insights into your Vehicle Maintenance Activities"){
        return $this->subject($this->mail->purpose)->view('mails.monthlyivim')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "There is a new opportunity post within your proximity"){
        return $this->subject($this->mail->purpose)->view('mails.opportunitypost')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "Payment Successfully processed"){
        return $this->subject($this->mail->purpose)->view('mails.approveestimate')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "Your vehicle maintenance is completed"){
        return $this->subject($this->mail->purpose)->view('mails.maintenancecomplete')
                    ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "A new mobile mechanic just signed up on VIM File"){
                return $this->subject($this->mail->purpose)->view('mails.newmobilemechanic')
                            ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "A new auto care center just signed up on VIM File"){
                return $this->subject($this->mail->purpose)->view('mails.newautocare')
                            ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "My weekly point achievement on Vimfile"){
                return $this->subject($this->mail->purpose)->view('mails.weeklypoint')
                            ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "My global point achievement on Vimfile"){
                return $this->subject($this->mail->purpose)->view('mails.globalpoint')
                            ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "Profile updated and will be reviewed"){
                return $this->subject($this->mail->purpose)->view('mails.messages')
                            ->with('maildata', $this->mail);
        }
        elseif($this->mail->purpose == "Profile Reviewed and Account Activated" || $this->mail->purpose == "Profile Reviewed and Account Declined"){

            if($this->mail->file != "noImage.png" || $this->mail->file != null || $this->mail->file != ""){
                return $this->subject($this->mail->purpose)
                    ->attach(asset("newsfile/".$this->mail->file))
                    ->view('mails.activateme')
                    ->with('maildata', $this->mail);
            }
            else{
                return $this->subject($this->mail->purpose)->view('mails.activateme')
                    ->with('maildata', $this->mail);
            }


        }

        elseif($this->mail->purpose == "Compose Mail"){

            if($this->mail->file != NULL){
                return $this->subject($this->mail->subject)
                            ->attach(asset("composemail/".$this->mail->file))
                            ->view('mails.messages')
                            ->with('maildata', $this->mail);
            }
            else{
                return $this->subject($this->mail->subject)->view('mails.messages')
                    ->with('maildata', $this->mail);
            }

        }

        elseif($this->mail->purpose){

            if($this->mail->file != "noImage.png" || $this->mail->file != null || $this->mail->file != ""){
                return $this->subject($this->mail->purpose)
                    ->attach(asset("newsfile/".$this->mail->file))
                    ->view('mails.newshapenning')
                    ->with('maildata', $this->mail);
            }
            else{
                return $this->subject($this->mail->purpose)->view('mails.newshapenning')
                    ->with('maildata', $this->mail);
            }


        }
    }
}
