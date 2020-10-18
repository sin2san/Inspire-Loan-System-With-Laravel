<p>This system is about a authenticated customer will apply for loan, where authenticated admin will approve / reject the loan and authenticated customer will have a weekly repayment amount to be paid for approved loan.</p>
<Strong>To Install The System Follow The Below Instructions</strong><br>
<ul>
<li>Clone repository to local machine.</li>
<li>Run cmd cp .env.example .env</li>
<li>Run cmd Composer install</li>
<li>Create database</li>
<li>Update database details in .env file</li>
<li>Run cmd php artisan key:generate</li>
<li>Run cmd php artisan config:cache</li>
<li>Run cmd php artisan migrate</li>
<li>Run cmd php artisan db:seed</li>
<li>Run cmd php artisan storage:link</li>
<li>Run cmd php artisan serve and visit http://127.0.0.1:8000</li>
<li>Click login from header</li>
<li>Enter credentials</li>
    <br>
    <p><strong>For customer:</strong><br> 
<strong>username:</strong> customer@inspire.com<br>
<strong>password:</strong> customer</p>

<p><strong>For admin:</strong><br>
<strong>username:</strong> admin@inspire.com<br>
<strong>password:</strong> admin</p>

<p><strong>Customer Scenario:</strong><br>
    <strong>Apply loan:</strong><br>
Click loan from the left sidebar and click apply from header. Fill in the details and submit.</p>
    
<p><strong>Repay loan:</strong><br>
Click loan from the left sidebar and click pay button for the loan to be repaid. Check the weekly repay amount and click submit.</p>

<p><strong>Payment history:</strong><br>
Click loan from the left sidebar and click history button of the loan to check payment history. Check the loan details and payment history.</p>

<p><strong>Admin Scenario:</strong><br>
    <strong>Approve / Reject loan:</strong><br>
Click loan from the left sidebar and click approve to approve loan or reject to reject loan.</p>

<p><strong>Payment history:</strong><br>
Click loan from the left sidebar and click history button of the loan to check payment history. Check the loan details and payment history.</p>

<hr>

<strong>User Story </strong><br>
<p><strong>Customer Applying For Loan:</strong><br>
As an existing customer, I need to log in so that I can apply for loan.</p>

<p><strong>Acceptance Criteria:</strong><br>
Given I’m an existing customer, after logged in when I click loan from the left sidebar, the system shows me a list of previous loan histories. I click on apply from the header then it asks me the loan term and amount, when I select loan term, enter amount and click submit, then the system shows the “You are successfully applied for loan.” message.</p>

<p><strong>Admin Approving / Rejecting Loans:</strong><br>
As an existing admin, I need to log in so that I can take action on pending loan approvals.</p>

<p><strong>Acceptance Criteria:</strong><br>
Given I am an admin user, after logged in when I click loan from the left sidebar, the system showing me the list of loans. I click on approve to approve the loan, then the system shows the “Loan status is successfully updated.” message. I click on reject to reject the loan, then the system shows the “Loan status is successfully updated.” message.</p>

<p><strong>Customer Repaying Loan:</strong><br>
As a logged in customer, I want to update weekly repayment amount so that I can close my loan.</p>

<p><strong>Acceptance Criteria:</strong><br>
Given that I am a logged in customer, when I click loan from the left sidebar, the system shows me the list of loans. I click on pay button to the loan that I need to repay, then the system shows me the weekly amount to be paid, I click submit, then the system shows the “Your payment is successfully recorded as paid.” message and the outstanding amount from the loan history is reduced.</p>

<p><strong>Loan Payment History:</strong><br>
As a logged in customer (or) admin, I want to check repayment history of a loan so that I can keep track of pending amounts.</p>

<p><strong>Acceptance Criteria:</strong><br>
Given that I am a logged in customer (or) admin, when I click loan from the left sidebar, the system shows me the list of loans. I click on history button to the loan that I need to check repayment history, then the system shows me the loan details and repayment history. </p>
