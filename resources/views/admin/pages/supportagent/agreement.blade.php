<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Sales Rep Agreement</title>
  </head>
  <body>

    <div class="container">

        <h2 class="text-center p-3"><u>Sales Rep Agreement</u></h2>


        
        <p>This Agreement (“Agreement”) is made and effective on by and between <b>{{ $data['agentdetails'][0]->name }} </b> and  <b>PROFESSIONALS’ FILE INC.</b></p>
        

        <p>
            In consideration of the mutual promises contained herein, the parties agree as follows:
        </p>

        @if ($data['agentdetails'][0]->signed_agreement == 1)
            <img src="https://res.cloudinary.com/pilstech/image/upload/v1607621647/signed_cqq4kr.png" alt="" style="width: 150px; height: 150px;" align="right">
        @endif

        <h5>
            <b>1. Definitions.</b>
        </h5>
        <p>
            As used herein, the following terms shall have the meanings set forth below:
        </p>
        <p>
            A.    <b>“Products”</b> shall mean the following of Company’s products to be sold by Rep:
            BUSY WRENCH BY VIMFILE
        </p>
        <p>
            B.    <b>“Territory”</b> shall mean the following described geographic area and/or specific accounts:
        </p>


        <h5>
            <b>2. Appointment.</b>
        </h5>
        <p>
            Company hereby appoints Rep as its sales rep for the Products in the Territory, and Rep hereby accepts such appointment.  Rep’s sole authority shall be to solicit orders for the Products in the Territory in accordance with the terms of this Agreement.  Rep shall not have the authority to make any commitments whatsoever on behalf of Company, and be fully responsible for keeping his or her customers duly informed of this limit on Rep’s authority to make agreements on behalf of the Company with the customer.
        </p>


        <h5>
            <b>3. General Duties.</b>
        </h5>
        <p>
            Rep shall use its best efforts to promote the Products and maximize the sale of the Products in the Territory.  Rep shall also provide reasonable assistance to Company in promotional activities in the Territory such as trade shows, product presentations, sales calls and other activities of Company with respect to the Products.  Rep shall also provide reasonable “after sale” support to Product purchasers and generally perform such sales related activities as are reasonable to promote the Products and the goodwill of Company in the Territory, in the line of business Company is in.  Rep shall report weekly to Company concerning sales of the Products and competitive promotional ad pricing activities.  Rep will devote adequate time and effort to perform its obligations.  Rep shall neither advertise the Products outside the Territory nor solicit sales from purchasers located outside the Territory without the prior written consent of the Company.
        </p>


        <h5>
            <b>4. Reserved Rights.</b>
        </h5>
        <p>
            Company reserves the right to solicit orders directly from and sell directly to any end users or other retail buyers within the Territory.  Rep’s task is to solicit orders from all potential customers in the Territory including Auto-dealers, value-added resellers, telemarketing companies and retail distribution chains, unless agreed otherwise else in this agreement.
        </p>


        <h5>
            <b>5. Conflict of Interest.</b>
        </h5>
        <p>
            Rep warrants to Company that it does not currently represent or promote any lines or products that compete with the Products.  During the term of this Agreement, Rep shall not represent, promote or otherwise try to sell within the Territory any lines or products that, in Company’s judgment, compete with the Products covered by this Agreement.  Rep shall provide Company with a list of the companies and products that it currently represents and shall notify Company in writing of any new companies and products at such time as its promotion of those new companies and products commence.
        </p>


        <h5>
            <b>6. Independent Contractor.</b>
        </h5>
        <p>
            Rep is an independent contractor, and nothing contained in this Agreement shall be construed to (i) give either party the power to direct and control the day-to-day activities of the other, (ii) constitute the parties as partners, joint venturers, co-owners or otherwise, or (iii) allow Rep to create or assume any obligation on behalf of Company for any purpose whatsoever.  Rep is not an employee of Company and is not entitled to any employee benefits.  Rep shall be responsible for paying all income taxes and other taxes charged to Rep on amounts earned hereunder.  All financial and other obligations associated with Rep’s business are the sole responsibility of Rep.
        </p>


        <h5>
            <b>7. Indemnification by Rep.</b>
        </h5>
        <p>
            Rep shall indemnify and hold Company free and harmless from any and all claims, damages or lawsuits (including reasonable attorneys’ fees) arising out of negligence or malfeasant acts of Rep, its employees or its agents.
        </p>


        <h5>
            <b>8. Indemnification by Company.</b>
        </h5>
        <p>
            Company shall indemnify and hold Rep free and harmless from any and all claims, damages or lawsuits (including reasonable attorneys’ fees) arising out of defects in the Products caused by Company or failure of Company to provide any products to a customer that has properly ordered through Rep.
        </p>
        
        
        <h5>
            <b>9. Commission.</b>
        </h5>
        <p>
            <b>Sole Compensation.</b>  Rep’s sole compensation under the terms of this Agreement shall
            be a commission computed as follows: <b>30% of Paid Subscription</b>
        </p>

        <p>
            <b>Basis of Commission.</b> The Commission shall apply to all paid subscription solicited by Rep from the Territory that have been accepted by Company.  No commissions shall be paid on 
        </p>

        <p>
            (i)	orders from outside the Territory (even if Rep receives the initial inquiry from outside the Territory) unless otherwise agreed in writing by Company.  Commissions shall be computed on the net amount paid by customer.
        </p>

        <p>
            (ii)	No commission shall be paid on Consumer on 30-Day Trial or Free plan on the products
        </p>


        <p>
            <b>Time of Payment.</b>  The commission on a given order shall be due and payable when paid by the customer and be due within 5 days after such payment is received.
        </p>

        <p>
            <b>Annual Inspection of Records.</b>  Rep shall be provided with online access to reports on accounts WON, status of subscription, commission earned and paid as part of the on-boarding process of the Rep.
        </p>

        <h5>
            <b>10. Sale of the Products.</b>
        </h5>

        <p>
            <b>Prices and Terms of Sale.</b>  Company shall provide Rep with copies of its current price lists, delivery schedules, and standard terms and conditions of sale, as established from time to time.  Rep shall quote to customers only those authorized prices, delivery schedules, and terms and conditions, and modify, add to or discontinue Products following written notice to Rep. Each order shall be controlled by the prices, delivery schedules, and terms and conditions in effect at the time the order is accepted, and all quotations by Reps shall contain a statement to that effect.
        </p>
        <p>
            <b>Quotations.</b>Reps shall promptly furnish to Company copies of all quotations submitted to customers.  Each quotation shall accurately reflect the terms of this Agreement.
        </p>

        <p>
            <b>Orders.</b> All orders for the Products shall be in writing, and the originals shall be submitted to Company.  All orders shall be sent directly from the customer to the Company not to the Rep for forwarding to the Company.
        </p>

        <p>
            <b>Acceptance.</b>  All orders obtained by Rep shall be subject to final acceptance by Company at its principal office and all quotations by Reps shall contain a statement to that effect.  Rep shall have no authority to make any acceptance or delivery commitments to customers.  Company specifically reserves the right to reject any order or any part thereof for any reason.
        </p>


        <p>
            <b>Acceptance.</b>  All orders obtained by Rep shall be subject to final acceptance by Company at its principal office and all quotations by Reps shall contain a statement to that effect.  Rep shall have no authority to make any acceptance or delivery commitments to customers.  Company specifically reserves the right to reject any order or any part thereof for any reason.
        </p>


        <p>
            <b>Credit Approval.</b>  Company shall have the sole right of credit approval or credit refusal for customers in all cases, with or without cause.
        </p>

        <p>
            <b>Collection.</b>  Full responsibility for collection from customers rests with Company, provided that Rep shall at Company’s request assist in such collection efforts.
        </p>


        <p>
            <b>Inquiries from Outside the Territory.</b>  Rep shall promptly submit to Company, for Company’s attention and handling, the originals of all inquiries received by Rep from customers outside the Territory.
        </p>


        <h5>
            <b>11. Term and Termination.</b>
        </h5>

        <p>
            <b>A. Term.</b>  This Agreement shall commence on   {{ date('d-m-Y', strtotime($data['agentdetails'][0]->created_at)) }} and continue for one year thereafter, unless terminated earlier as provided herein.  This Agreement shall continue until terminated upon at least 30 Days written notice by either party.  If not terminated during the first year, this Agreement shall continue until one party or the other terminates the Agreement with 30 Days written notice.
        </p>
        <p>
            <b>B. Return of Materials.</b>  All of Company’s trademarks, trade names, patents, copyrights, designs, drawings, formulas or other data, photographs, demonstrators, literature, and sales aids of every kind shall remain the property of Company.  Within 10 days after the termination of this Agreement, Rep shall return all such items to company at Rep’s expense.  Rep shall not make or retain any copies of any confidential items or information that may have been entrusted to it.  Effective upon the termination of this Agreement, Rep shall cease to use all trademarks, marks and trade name of Company.
        </p>


        <h5>
            <b>12. Limitation of Liability.</b>
        </h5>

        <p>
            Upon termination by either party in accordance with any of the provisions of this Agreement, neither party shall be liable to the other, because of the termination for compensation, reimbursement or damages on account of the loss of prospective profits or anticipated sales or on account of expenditures, investments, leases or commitments in connection with the business or goodwill of Company or Rep. Company’s sole liability under the terms of this Agreement shall be for any unpaid commissions.
        </p>


        <h5>
            <b>13. Confidentiality.</b>
        </h5>

        <p>
            Rep acknowledges that by reason of its relationship to Company hereunder it will have access to certain information and materials concerning Company’s business plans, customers, technology, and products that is confidential and of substantial value to Company, which value would be impaired if such information were disclosed to third parties.  Rep agrees that it shall not use in any way for its own account or the account of any third party, nor disclose to any third party, any such confidential information revealed to it by Company.  Rep shall not publish any technical description of the Products beyond the description published by Company.  In the event of termination of this Agreement, there shall be no use or disclosure by Rep of any confidential information of Company, and Rep shall not manufacture or have manufactured any devices, components or assemblies utilizing Company’s patents, inventions, copyrights, know-how or trade secrets.
        </p>


        <h5>
            <b>14. Notices.</b>
        </h5>

        <p>
            Any notices required or permitted by this Agreement shall be deemed given if sent by email, certified mail, postage prepaid, return receipt requested or by recognized an over night delivery service such as FedEx:
        </p>

        <p>
            If to Company: <b>Professionals' File Inc. 10 George St. North, Brampton ON L6X1R2, Canada</b>
            
        </p>
        <p>
            If to Rep: <b>{{ $data['agentdetails'][0]->name.' '.$data['agentdetails'][0]->address }}</b>
            
        </p>


        <h5>
            <b>15.  No Waiver.</b>
        </h5>

        <p>
            The waiver or failure of either party to exercise in any respect any right provided in this agreement shall not be deemed a waiver of any other right or remedy to which the party may be entitled.
        </p>


        <h5>
            <b>16.  Entirety of Agreement.</b>
        </h5>

        <p>
            The terms and conditions set forth herein constitute the entire agreement between the parties and supersede any communications or previous agreements with respect to the subject matter of this Agreement.  There are no written or oral understandings directly or indirectly related to this Agreement that are not set forth herein.  No change can be made to this Agreement other than in writing and signed by both parties.
        </p>


        <h5>
            <b>17.  Governing Law.</b>
        </h5>

        <p>
            This Agreement shall be construed and enforced according to the laws of the <b>Province of Ontario, Canada</b> and any dispute under this Agreement must be brought in this venue and no other.
        </p>


        <h5>
            <b>18.  Headings in this Agreement</b>
        </h5>

        <p>
            The headings in this Agreement are for convenience only, confirm no rights or obligations in either party, and do not alter any terms of this Agreement.
        </p>


        <h5>
            <b>19.  Severability.</b>
        </h5>

        <p>
            If any term of this Agreement is held by a court of competent jurisdiction to be invalid or unenforceable, then this Agreement, including all of the remaining terms, will remain in full force and effect as if such invalid or unenforceable term had never been included.
        </p>

        <p>
            In Witness whereof, the parties have executed this Agreement as of the date first written above.
        </p>

        <br>
        <br>

        <div class="row">
            <div class="col-md-6">
                <p style="text-align: center">
                    <b>_________SHALOM ADEBIYI_________</b><br>
                    <span>Company Rep</span>
                </p>
            </div>
            <div class="col-md-6">

                <p style="text-align: center">
                    <b>_________{{ $data['agentdetails'][0]->name }}_________</b><br>
                    <span>Sales Rep</span>
                </p>

                
            </div>
        </div>

        <br>
        <br>

        @if ($data['agentdetails'][0]->signed_agreement == 0)
        <div class="row mb-5">
            <div class="col-md-12">
                <center>
                    <form action="{{ route('signagreement', $data['agentdetails'][0]->id) }}" method="post">@csrf
                    <button type="submit" class="btn btn-primary">Sign Agreement</button>
                        
                    </form>
                </center>
            </div>
        </div>
        @endif
        
    </div>






    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    
  </body>
</html>