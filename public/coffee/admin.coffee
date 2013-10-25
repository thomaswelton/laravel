require ['jquery', 'twbs', 'laravel-validator'], ($) ->
	console.log 'Admin'

	form = $('form[data-validation-rules]')
	validationRules = $(form).data('validation-rules')

	$(form).submit (e) ->
		e.preventDefault()

		$('.error-message').each (index, value) ->
			value.innerText = ' '

		validationForm = $(@).validator validationRules

		validationForm.fails (errors) ->
			errors.allElements().each (index, value) ->
				$(value).siblings('.error-message')[0].innerText = errors.all()[index]

		validationForm.passes () ->
			$(@).submit()
