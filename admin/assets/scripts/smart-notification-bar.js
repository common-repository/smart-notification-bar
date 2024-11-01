jQuery(document).ready(function () {
	/**
	 * Datepickers - visible from and to fields
	 */
	jQuery("#visible_from").datepicker({
		dateFormat: "yy-mm-dd",
		minDate: 0,
	});

	jQuery("#visible_to").datepicker({
		dateFormat: "yy-mm-dd",
		minDate: 0,
	});

	/**
	 * Colorpickers for background and font colors
	 */
	jQuery(`.colorpicker`).spectrum({
		clickoutFiresChange: !0,
		showInput: !0,
		showInitial: !0,
		allowEmpty: !1,
		showAlpha: !0,
		preferredFormat: "hex",
	});

	/**
	 * Font family selector
	 */
	jQuery(`.selectric`).selectric({
		optionsItemBuilder: function (itemData) {
			return itemData.value.length ? `<span class="${itemData.value}">${itemData.text}</span>` : itemData.text;
		},
		onChange: function (element) {
			const currentSelect = element.id ? element.id : null;
			// updata preview
			if (currentSelect && currentSelect == "font_family") {
				jQuery(`#font_family`).trigger(`change`);
			} else if (currentSelect && currentSelect == "cta_font_family") {
				jQuery(`#cta_font_family`).trigger(`change`);
			}
		},
	});
});

(($) => {
	class epSmartNotificationbar {
		notificationBarPreviewElements = {
			content: $(`#smart-notification-bar__editor-preview .preview__content`),
			body: $(`#smart-notification-bar__editor-preview .preview__body`),
			cta: $(`#smart-notification-bar__editor-preview .preview__cta .cta__content`),
			close: $(`#smart-notification-bar__editor-preview .preview__close`),
		};

		/**
		 * Change preview on color picker move
		 */
		colorPreviewMove = (item, color) => {
			let currentItem = item.currentTarget.id;
			let currentColor = color.toRgbString();

			item.target.value = currentColor;

			switch (currentItem) {
				case "font_color":
					$(`#smart-notification-bar__editor-preview .preview__body`).css({
						color: currentColor,
					});
					break;

				case "background_color":
					$(`#smart-notification-bar__editor-preview .preview__content`).css({
						backgroundColor: currentColor,
					});
					break;

				case "cta_color":
					$(`#smart-notification-bar__editor-preview a`).css({
						color: currentColor,
					});
					break;

				case "cta_background":
					$(`#smart-notification-bar__editor-preview a`).css({
						background: currentColor,
						borderColor: currentColor,
					});
					break;

				case "close_button_color":
					$(`#smart-notification-bar__editor-preview .preview__close`).css({
						color: currentColor,
					});
					break;

				default:
					break;
			}
		};

		/**
		 * Update notification bar preview
		 */
		updatePreview = () => {
			// update content
			$(`#smart-notification-bar__editor-preview .preview__body`).html($(`#content`).val());

			let height = $(`#height`).val();
			// update height
			$(`#smart-notification-bar__editor-preview .preview__content`).css({
				height: `${height}px`,
			});

			// add extra margin to form if necessary
			if (height > 40) {
				let marginTop = height - 40 + 130;
				$(`#smart-nofitication-bar-form`).css({
					marginTop: `${marginTop}px`,
				});
			}

			// update font color, font size
			$(`#smart-notification-bar__editor-preview .preview__body`).css({
				color: $(`#font_color`).val(),
				fontSize: `${$(`#font_size`).val()}px`,
			});

			// update font family
			$(`#smart-notification-bar__editor-preview .preview__body`).attr("class", `preview__body ${$(`#font_family`).val()}`);

			// update background color, background image
			$(`#smart-notification-bar__editor-preview .preview__content`).css({
				backgroundColor: $(`#background_color`).val(),
				backgroundImage: `url( ${$("#background_image").val()} )`,
			});

			// update cta style, cta animation, cta font family, cta text, cta url, cta font size
			$(`#smart-notification-bar__editor-preview a`)
				.attr(`class`, `cta__content ep_smart_notification_bar_cta_style_${$("input[name='cta_style']:checked").val()} ep_smart_notification_bar_cta_animation_${$("input[name='cta_animation']:checked").val()} ${$(`#cta_font_family`).val()}`)
				.html($("#cta_content").val())
				.attr(`href`, $("#cta_url").val())
				.css({
					color: $(`#cta_color`).val(),
					background: $(`#cta_background`).val(),
					borderColor: $(`#cta_background`).val(),
					fontSize: `${$(`#cta_font_size`).val()}px`,
				});

			// update close button color
			$(`#smart-notification-bar__editor-preview .preview__close`).css({
				color: $(`#close_button_color`).val(),
			});

			// show, hide CTA
			if ($(`input[name="display_cta"]`).is(":checked")) {
				// show cta
				$(`#smart-notification-bar__editor-preview .preview__cta`).removeClass(`hidden`);
			} else {
				// hide cta
				$(`#smart-notification-bar__editor-preview .preview__cta`).addClass(`hidden`);
			}

			// show, hide close button
			if ($(`input[name="display_close_button"]`).is(":checked")) {
				// show cta
				$(`#smart-notification-bar__editor-preview .preview__close`).show();
			} else {
				// hide cta
				$(`#smart-notification-bar__editor-preview .preview__close`).hide();
			}
		};

		/**
		 * Toggle date fields when changing notificaiton bar active status
		 */
		toggleDateSections = (action) => {
			if ($(`#visible-from-section`).hasClass(`hidden`) && action == "show") {
				// show fields
				$(`#visible-from-section`).removeClass(`hidden`);
				$(`#visible-to-section`).removeClass(`hidden`);
			} else {
				// hide fields
				$(`#visible-from-section`).addClass(`hidden`);
				$(`#visible-to-section`).addClass(`hidden`);
			}
		};

		/**
		 * Show or hide CTA settings sections
		 */
		toggleCtaSettingsSections = () => {
			if ($(`#display_cta`).is(":checked")) {
				// show cta settings sections
				$(`.smart-notification-bar-cta-section`).removeClass(`hidden`);
			} else {
				// hide sections
				$(`.smart-notification-bar-cta-section`).addClass(`hidden`);
			}
		};

		/**
		 * Show or hide close button settings sections
		 */
		toggleCloseSettingsSections = () => {
			if ($(`#display_close_button`).is(":checked")) {
				// show sections
				$(`.smart-notification-bar-close-button-section`).removeClass(`hidden`);
			} else {
				// hide sections
				$(`.smart-notification-bar-close-button-section`).addClass(`hidden`);
			}
		};

		/**
		 * Show or hide display rule settings
		 */
		toggleDisplayRuleSettings = () => {
			let selectedOption = $(`input[name="display_rule"]:checked`).val();
			if (selectedOption == "defined_pages") {
				// show defined pages settings
				$(`.display-rule-defined-pages-section`).removeClass(`hidden`);
				// hide excluded pages settings
				$(`.display-rule-excluded-pages-section`).addClass(`hidden`);
			} else if (selectedOption == "excluded_pages") {
				// show excluded pages settings
				$(`.display-rule-excluded-pages-section`).removeClass(`hidden`);
				// hide defined pages settings
				$(`.display-rule-defined-pages-section`).addClass(`hidden`);
			} else {
				// hide defined pages settings
				$(`.display-rule-defined-pages-section`).addClass(`hidden`);
				// hide excluded pages settings
				$(`.display-rule-excluded-pages-section`).addClass(`hidden`);
			}
		};

		/**
		 * Toggle visitor source rules
		 */
		toggleVisitorSourceRules = () => {
			if ($(`input[name="display_for_every_visitor"]:checked`).val() == 0) {
				// hide sections
				$(`.specific-visitor-settings__section`).removeClass(`hidden`);
			} else {
				// show sections
				$(`.specific-visitor-settings__section`).addClass(`hidden`);
			}
		};

		/**
		 * Toggle section to set up specific parameters
		 */
		toggleSpecificParameters = () => {
			if ($(`#display_for_visitors_with_parameter`).is(":checked")) {
				// show section
				$(`#specific-parameter-settings`).removeClass(`hidden`);
			} else {
				// hide section
				$(`#specific-parameter-settings`).addClass(`hidden`);
			}
		};

		/**
		 * Check the value of a field
		 */
		checkValue = (element) => {
			if (!element.value) {
				if (element.classList.contains("ep-plugin-field-error")) {
					return;
				}

				// display error message
				element.classList.add("ep-plugin-field-error");

				let errorMessage = document.createElement("div");
				errorMessage.classList.add("ep-plugin-error-message");
				errorMessage.id = `ep-plugin-error-message-${element.id}`;
				errorMessage.innerText = element.dataset.fieldError;

				element.parentNode.insertBefore(errorMessage, element.nextSibling);
			} else {
				// remove error message if exists
				if (document.querySelector(`#ep-plugin-error-message-${element.id}`)) {
					element.classList.remove("ep-plugin-field-error");
					document.querySelector(`#ep-plugin-error-message-${element.id}`).remove();
				}
			}
		};

		/**
		 * Save notification bar data
		 */
		saveNotificationBarData = () => {
			let notificationBarData = {};
			let errorCount = 0;
			let errorMessages = [];
			/**
			 * Check required fields
			 */

			// name
			if (!$(`#name`).val()) {
				// dispaly error
				errorCount++;
				this.checkValue(document.getElementById(`name`));
				errorMessages.push(`Name is required.`);
			} else {
				this.checkValue(document.getElementById(`name`));
			}

			// content
			if (!$(`#content`).val()) {
				// dispaly error
				errorCount++;
				this.checkValue(document.getElementById(`content`));
				errorMessages.push(`The content of your Notification Bar is required.`);
			} else {
				this.checkValue(document.getElementById(`content`));
			}

			// visible from and to dates, if the notification bar is active
			if ($(`#active`).is(":checked")) {
				if (!$(`#visible_from`).val()) {
					errorCount++;
					this.checkValue(document.getElementById(`visible_from`));
					errorMessages.push(`When the notification bar is active, the start date is required.`);
				} else {
					this.checkValue(document.getElementById(`visible_from`));
				}

				if (!$(`#visible_to`).val()) {
					errorCount++;
					this.checkValue(document.getElementById(`visible_to`));
					errorMessages.push(`When the notification bar is active, the end date is required.`);
				} else {
					this.checkValue(document.getElementById(`visible_to`));
				}
			}

			// height
			if (!$(`#height`).val()) {
				errorCount++;
				this.checkValue(document.getElementById(`height`));
				errorMessages.push(`Height is required.`);
			} else {
				this.checkValue(document.getElementById(`height`));
			}

			// display validation result
			if (errorCount) {
				const finalErrorMessage = errorMessages.map((errorMessage) => `<li> ${errorMessage}</li>`).join("");

				document.querySelectorAll(".ep-plugin-form-result--error").forEach((errorSection) => {
					errorSection.querySelector(".ep-plugin-form-result__content").innerHTML = `<ul>${finalErrorMessage}</ul>`;
					errorSection.classList.remove("hidden");
				});

				document.querySelectorAll(".ep-plugin-form-result--success").forEach((successSection) => {
					successSection.querySelector(".ep-plugin-form-result__content").innerHTML = "";
					successSection.classList.add("hidden");
				});

				document.querySelector(".ep-plugin-form-result__modal").classList.remove("hidden");

				return;
			} else {
				document.querySelectorAll(".ep-plugin-form-result").forEach((formResultSection) => {
					formResultSection.classList.add("hidden");
				});
				document.querySelector(".ep-plugin-form-result__modal").classList.add("hidden");
			}

			/**
			 * Disable save buttons
			 */
			$(`.ep-plugin-save-smart-notification-bar`).each((i, button) => {
				// disable button
				$(button).attr(`disabled`, true);

				// show loading icon
				$(button).children(`i`).removeClass(`hidden`);
			});

			/**
			 * Collect notification bar data
			 */
			// normal fields
			$(`.notification-bar-data`).each((i, field) => {
				notificationBarData[$(field).attr(`name`)] = $(field).val();
			});

			// checkboxes
			$(`.notification-bar-data--checkbox`).each((i, field) => {
				let checked = $(field).is(":checked") ? 1 : 0;
				notificationBarData[$(field).attr(`name`)] = checked;
			});

			// radiobuttons
			$(`.notification-bar-data--radio`).each((i, field) => {
				if ($(field).is(":checked")) {
					notificationBarData[$(field).attr(`name`)] = $(field).val();
				}
			});

			// selects
			$(`.notification-bar-data--select`).each((i, field) => {
				notificationBarData[$(field).attr(`name`)] = $(field).val();
			});

			/**
			 * Send data to backend
			 */
			let notificationBarAction = "create";
			if (notificationBarId) {
				notificationBarAction = "update";
			}

			notificationBarData["id"] = notificationBarId;

			const data = {
				nonce: notificationBarNonce,
				action: "notification_bar_action",
				notificationBarAction,
				notificationBarData,
			};

			$.post(ajaxurl, data, (response) => {
				if (response.status != "success") {
					document.querySelectorAll(".ep-plugin-form-result--error").forEach((errorSection) => {
						errorSection.querySelector(".ep-plugin-form-result__content").innerHTML = response.data;
						errorSection.classList.remove("hidden");
					});

					document.querySelectorAll(".ep-plugin-form-result--success").forEach((successSection) => {
						successSection.querySelector(".ep-plugin-form-result__content").innerHTML = "";
						successSection.classList.add("hidden");
					});
					document.querySelector(".ep-plugin-form-result__modal").classList.remove("hidden");
				} else {
					if (notificationBarAction == "create") {
						// redirect to notification bar page
						window.location.href = `admin.php?page=smart-notification-bar-edit&id=${response.data}&msg=created`;
						return;
					} else {
						// display notification bar updated message
						document.querySelectorAll(".ep-plugin-form-result--success").forEach((successSection) => {
							successSection.querySelector(".ep-plugin-form-result__content").innerHTML = response.data;
							successSection.classList.remove("hidden");
						});

						// hide all previously displayed error messages, if there were any
						document.querySelectorAll(".ep-plugin-form-result--error").forEach((errorSection) => {
							errorSection.querySelector(".ep-plugin-form-result__content").innerHTML = "";
							errorSection.classList.add("hidden");
						});

						document.querySelector(".ep-plugin-form-result__modal").classList.remove("hidden");
					}
				}

				$(`.ep-plugin-save-smart-notification-bar`).each((i, button) => {
					// enable button
					$(button).attr(`disabled`, false);

					// show loading icon
					$(button).children(`i`).addClass(`hidden`);
				});
			});
		};

		/**
		 * Close modal on close button click
		 */
		closeModal = () => {
			$(`.ep-plugin-form-result__modal`).each((index, modal) => {
				$(modal).addClass("hidden");
			});
		};

		/**
		 * Delete notification bar
		 */
		deleteNotificationbar = (event) => {
			event.target.querySelector("i").classList.remove("hidden");
			event.target.disabled = true;

			let notificationBarAction = "delete";
			const data = {
				nonce: notificationBarNonce,
				action: "notification_bar_action",
				notificationBarAction,
				id: notificationBarId,
			};

			$.post(ajaxurl, data, (response) => {
				event.target.querySelector("i").classList.add("hidden");
				event.target.disabled = false;
				document.querySelector(".ep-plugin-form__delete-confirm-modal").classList.add("hidden");

				if (response.status != "success") {
					document.querySelectorAll(".ep-plugin-form-result--error").forEach((errorSection) => {
						errorSection.querySelector(".ep-plugin-form-result__content").innerHTML = response.data;
						errorSection.classList.remove("hidden");
					});
					document.querySelector(".ep-plugin-form-result__modal").classList.remove("hidden");
				} else {
					// redirect to list page
					window.location.href = `admin.php?page=smart-notification-bars-list&msg=deleted`;
					return;
				}
			});
		};

		/**
		 * Duplicate notification bar
		 */
		duplicateNotificationbar = (event) => {
			event.target.querySelector("i").classList.remove("hidden");
			event.target.disabled = true;

			let notificationBarAction = "duplicate";
			const data = {
				nonce: notificationBarNonce,
				action: "notification_bar_action",
				notificationBarAction,
				id: event.target.dataset.notificationBarId,
			};

			$.post(ajaxurl, data, (response) => {
				event.target.querySelector("i").classList.add("hidden");
				event.target.disabled = false;

				if (response.status != "success") {
					alert("There was an error during the process. Please, refresh the page and try again.");
				} else {
					// reload location with msg
					window.location.href = `admin.php?page=smart-notification-bars-list&msg=duplicated`;
					return;
				}
			});
		}

		/**
		 * Toggle delete confirm modal
		 */
		toggleDeleteConfirmModal = () => {
			if ($(`.ep-plugin-form__delete-confirm-modal`).hasClass(`hidden`)) {
				$(`.ep-plugin-form__delete-confirm-modal`).removeClass(`hidden`);
			} else {
				$(`.ep-plugin-form__delete-confirm-modal`).addClass(`hidden`);
			}
		};

		/**
		 * Toggle hidden after closed settings
		 */
		toggleHiddenAfterClosed = () => {
			if ($(`#hidden_after_closed`).is(":checked")) {
				// show settings
				$(`.smart-notification-bar-hidden-after-closed-section`).removeClass(`hidden`);
			} else {
				// hide settings
				$(`.smart-notification-bar-hidden-after-closed-section`).addClass(`hidden`);
			}
		};

		/**
		 * Upload background image
		 */
		uploadBackgroundImage = () => {
			let backgroundImageUploader;
			let attachment;

			backgroundImageUploader
				? backgroundImageUploader.open()
				: ((backgroundImageUploader = wp.media.frames.backgroundImageUploader = wp.media({
						title: "Select background image",
						button: {
							text: "Use this image",
						},
						multiple: !1,
				  })).on("select", function () {
						attachment = backgroundImageUploader.state().get("selection").first().toJSON();
						// set background image field value
						$(`#background_image`).val(attachment.url);
						// display background image preview
						$(`#background-image-preview img`).attr(`src`, attachment.url);
						$(`#background-image-preview`).removeClass(`hidden`);
						// update preview
						$(`#background_image`).trigger("change");
				  }),
				  backgroundImageUploader.open());
		};

		/**
		 * Remove background image
		 */
		removeBackgroundImage = () => {
			// set background image field value
			$(`#background_image`).val("");
			// hide background image preview
			$(`#background-image-preview img`).attr(`src`, "");
			$(`#background-image-preview`).addClass(`hidden`);
			// update preview
			$(`#background_image`).trigger("change");
		};

		/**
		 * Preview CTA animation
		 */
		toggleCTAanimationPreview = (e) => {
			const currentAnimation = e.currentTarget.dataset.animation;
			if (e.type == "mouseover") {
				// show animation
				$(`label[data-animation="${currentAnimation}"] .cta-animation-preview span`).attr("class", `animation-${currentAnimation}`);
			} else {
				// hide animation
				$(`label[data-animation="${currentAnimation}"] .cta-animation-preview span`).attr("class", ``);
			}
		};

		/**
		 * Handle section toggle
		 * @param {object} e event object
		 */
		toggleFormSectionBody = (e) => {
			const section = e.target.closest(".ep-plugin-card__section");
			if (section.classList.contains("ep-plugin-card__section--closed")) {
				section.classList.remove("ep-plugin-card__section--closed");
				section.classList.add("ep-plugin-card__section--opened");
			} else {
				section.classList.remove("ep-plugin-card__section--opened");
				section.classList.add("ep-plugin-card__section--closed");
			}
		};

		notificationBarTemplate = "";

		/**
		 * Display or hide the notification bar template preview modal
		 * @param {object} e event object
		 * @param {string} action action type string
		 */
		toggleTemplatePreview = (e, action) => {
			if (action == "display") {
				this.notificationBarTemplate = e.currentTarget.dataset.template;
				const templateName = e.currentTarget.querySelector(".template-name").innerText;
				const previewImage = e.currentTarget.querySelector("img");
				$(`.ep-plugin-form__template-preview-modal-body`).html(previewImage.outerHTML);
				$(`#template-preview-name`).text(templateName);
				$(`.ep-plugin-form__template-preview-modal`).removeClass("hidden");
			} else {
				this.notificationBarTemplate = "";
				$(`.ep-plugin-form__template-preview-modal-body`).html("");
				$(`.ep-plugin-form__template-preview-modal`).addClass("hidden");
			}
		};

		/**
		 * Change notification bar layout based on the selected template
		 */
		useSelectedTemplate = () => {
			const templates = {
				light: {
					font_color: "#333333",
					background_color: "#ffffff",
					background_image: ``,
					cta_color: "#f7f7f7",
					cta_background: "#333333",
					close_button_color: "#888888",
				},
				dark: {
					font_color: "#f7f7f7",
					background_color: "#000000",
					background_image: ``,
					cta_color: "#333333",
					cta_background: "#ffffff",
					close_button_color: "#5b5b5b",
				},
				easter: {
					font_color: "#ffffff",
					background_image: `${notificationBarPublicFolder}assets/images/easter-background.png`,
					cta_color: "#ffffff",
					cta_background: "#2cb40a",
					close_button_color: "#ffffff",
				},
				summer: {
					font_color: "#ffffff",
					background_image: `${notificationBarPublicFolder}assets/images/summer-background.png`,
					cta_color: "#ffffff",
					cta_background: "#ed0303",
					close_button_color: "#ffffff",
				},
				backtoschool: {
					font_color: "#ffffff",
					background_image: `${notificationBarPublicFolder}assets/images/backtoschool-background.png`,
					cta_color: "#ffffff",
					cta_background: "#ed0303",
					close_button_color: "#ffffff",
				},
				halloween: {
					font_color: "#ffffff",
					background_image: `${notificationBarPublicFolder}assets/images/halloween-background.png`,
					cta_color: "#ffffff",
					cta_background: "#000000",
					close_button_color: "#f39400",
				},
				blackfriday: {
					font_color: "#ffffff",
					background_image: `${notificationBarPublicFolder}assets/images/blackfriday-background.png`,
					cta_color: "#ffffff",
					cta_background: "#c50000",
					close_button_color: "#ffffff",
				},
				christmas: {
					font_color: "#ffffff",
					background_image: `${notificationBarPublicFolder}assets/images/christmas-background.png`,
					cta_color: "#ffffff",
					cta_background: "#119200",
					close_button_color: "#ffffff",
				},
				discount: {
					font_color: "#ffffff",
					background_image: `${notificationBarPublicFolder}assets/images/discount-background.png`,
					cta_color: "#ffffff",
					cta_background: "#000000",
					close_button_color: "#ffffff",
				},
			};

			const selectedTemplate = templates[this.notificationBarTemplate];
			/**
			 * Update fields
			 */
			let field;
			for (field in selectedTemplate) {
				$(`#${field}`).val(selectedTemplate[field]);

				if (field.includes("color") || field.includes("background")) {
					$(`#${field}`).spectrum("set", selectedTemplate[field]);
				}

				if (field == "background_image" && selectedTemplate[field].length > 3) {
					// set selected background image
					$(`#background-image-preview img`).attr(`src`, selectedTemplate[field]);
					$(`#background-image-preview`).removeClass(`hidden`);
				} else if (field == "background_image" && selectedTemplate[field].length < 3) {
					$(`#background-image-preview img`).attr(`src`, ``);
					$(`#background-image-preview`).addClass(`hidden`);
				}
			}

			/**
			 * Update preview
			 */
			this.updatePreview();

			/**
			 * Close template modal
			 */
			this.toggleTemplatePreview(null, "hide");
		};

		/**
		 * Init smart notification bar functions
		 */
		init = () => {
			/**
			 * Toggle visible from-to sections
			 */
			$(`#active`).on(`click`, (e) => {
				if ($(e.currentTarget).is(":checked")) {
					this.toggleDateSections("show");
				} else {
					this.toggleDateSections("hide");
				}
			});

			/**
			 * Update preview
			 */
			// on content change
			$(`#content`).on("keyup", this.updatePreview);
			// on height change
			$(`#height`).on("change", this.updatePreview);
			$(`#height`).on("keyup", this.updatePreview);
			// on font color change
			$(`#font_color`).on("change", this.updatePreview);
			// on font family change
			$(`#font_family`).on("change", this.updatePreview);
			// on font size change
			$(`#font_size`).on("keyup", this.updatePreview);
			$(`#font_size`).on("change", this.updatePreview);
			// on background color change
			$(`#background_color`).on("change", this.updatePreview);
			// on background image change
			$(`#background_image`).on("change", this.updatePreview);
			// on display cta change
			$(`input[name="display_cta"]`).on("change", this.updatePreview);
			// on cta style change
			$(`input[name="cta_style"]`).on("change", this.updatePreview);
			// on cta animation change
			$(`input[name="cta_animation"]`).on("change", this.updatePreview);
			// on cta content change
			$(`#cta_content`).on("keyup", this.updatePreview);
			// on cta url change
			$(`#cta_url`).on("keyup", this.updatePreview);
			// on cta font color change
			$(`#cta_color`).on("change", this.updatePreview);
			// on cta background color change
			$(`#cta_background`).on("change", this.updatePreview);
			// on cta font size change
			$(`#cta_font_size`).on("keyup", this.updatePreview);
			$(`#cta_font_size`).on("change", this.updatePreview);
			// on cta font family change
			$(`#cta_font_family`).on("change", this.updatePreview);
			// on display close button change
			$(`input[name="display_close_button"]`).on("change", this.updatePreview);
			// on close button color change
			$(`#close_button_color`).on("change", this.updatePreview);

			/**
			 * Update colors on colorpicker move
			 */
			$(`.colorpicker`).on("move.spectrum", (e, color) => {
				this.colorPreviewMove(e, color);
			});

			/**
			 * Update colors on colorpicker cancel
			 */
			$(`.colorpicker`).on("hide.spectrum", (e, color) => {
				this.colorPreviewMove(e, color);
			});

			/**
			 * Toggle hidden after closed settings
			 */
			$(`#hidden_after_closed`).on("change", this.toggleHiddenAfterClosed);

			/**
			 * Toggle CTA settings
			 */
			$(`#display_cta`).on("change", this.toggleCtaSettingsSections);

			/**
			 * Toggle Close button settings
			 */
			$(`#display_close_button`).on("change", this.toggleCloseSettingsSections);

			/**
			 * Toggle Display rules settings
			 */
			$(`input[name="display_rule"]`).on("change", this.toggleDisplayRuleSettings);

			/**
			 * Toggle visitor rules
			 */
			$(`input[name="display_for_every_visitor"]`).on("change", this.toggleVisitorSourceRules);

			/**
			 * Toggle specific URL parameters field
			 */
			$(`#display_for_visitors_with_parameter`).on("change", this.toggleSpecificParameters);

			/**
			 * Save notification bar data
			 */
			$(`.ep-plugin-save-smart-notification-bar`).on("click", this.saveNotificationBarData);

			/**
			 * Close modal
			 */
			$(`.ep-plugin-form-result__close-button`).each((index, button) => {
				$(button).on("click", this.closeModal);
			});

			this.updatePreview();

			/**
			 * Delete notification bar
			 */
			$(`#button--notification-bar-delete`).on("click", this.toggleDeleteConfirmModal);
			$(`.ep-plugin-form__delete-confirm-modal__close-button`).on("click", this.toggleDeleteConfirmModal);
			$(`#button--cancel-delete`).on("click", this.toggleDeleteConfirmModal);
			$(`#button--confirm-delete`).on("click", this.deleteNotificationbar);

			/**
			 * Duplicate notificatoon bar
			 */
			$(`.button--notification-bar-duplicate`).on("click", this.duplicateNotificationbar);

			/**
			 * Upload custom background image
			 */
			$(`#upload_background_image`).on("click", this.uploadBackgroundImage);

			/**
			 * Remove custom background image
			 */
			$(`#background-image-remove`).on("click", this.removeBackgroundImage);

			/**
			 * Preview CTA animation
			 */
			$(`#call-to-action-animation-list-container label`).on("mouseover", this.toggleCTAanimationPreview);
			$(`#call-to-action-animation-list-container label`).on("mouseleave", this.toggleCTAanimationPreview);

			/**
			 * Section accordion
			 */
			$(`.ep-plugin-form-group__label--accordion`).on("click", this.toggleFormSectionBody);

			/**
			 * Display notification bar template preview
			 */
			$(`#ep-plugin__template-list label`).on("click", (e) => {
				this.toggleTemplatePreview(e, "display");
			});

			/**
			 * Close notification bar template preview
			 */
			$(`.ep-plugin-form__template-preview-modal__close-button`).on("click", (e) => {
				this.toggleTemplatePreview(e, "hide");
			});
			$(`#button--cancel-template-preview`).on("click", (e) => {
				this.toggleTemplatePreview(e, "hide");
			});

			/**
			 * Use selected template
			 */
			$(`#button--confirm-template-preview`).on("click", this.useSelectedTemplate);
		};
	}

	const epNotificationBar = new epSmartNotificationbar();
	epNotificationBar.init();
})(jQuery);

let currentLocation = window.top.location.href;
if (currentLocation.includes("msg=created")) {
	window.history.pushState("notificationbarcreated", "", currentLocation.replace("msg=created", ""));
}

if (currentLocation.includes("msg=duplicated")) {
	window.history.pushState("notificationbarduplicated", "", currentLocation.replace("msg=duplicated", ""));
}
