<p>{{ __('strings.emails.report_broker.email_body_title') }}</p>

<p><strong>{{ __('validation.attributes.frontend.broker_id') }}:</strong> {{ $request->broker_id }}</p>
<p><strong>{{ __('validation.attributes.frontend.broker_name') }}:</strong> {{ $request->broker_name }}</p>
<p><strong>{{ __('validation.attributes.frontend.surename') }}:</strong> {{ $request->surename or "N/A" }}</p>
<p><strong>{{ __('validation.attributes.frontend.message') }}:</strong> {{ $request->message }}</p>