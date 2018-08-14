{{ __('strings.emails.report_broker.email_body_title') }}

{{ __('validation.attributes.frontend.broker_id') }}: {{ $request->broker_id }}
{{ __('validation.attributes.frontend.broker_name') }}: {{ $request->broker_name }}
{{ __('validation.attributes.frontend.surename') }}: {{ $request->surename or "N/A" }}
{{ __('validation.attributes.frontend.message') }}: {{ $request->message }}