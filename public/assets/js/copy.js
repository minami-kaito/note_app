function CopyViewModel() {
    const self = this;
    self.textToCopy = ko.observable('');

    self.copyText = function() {
        navigator.clipboard.writeText(self.textToCopy())
            .then(function() {
                notie.alert({ type: 1, text: 'URLをコピーしました'});
                console.log('Text copied to clipboard');
            })
            .catch(function(error) {
                console.error('Failed to copy text:', error);
            });
    };
}

var viewModel = new CopyViewModel();
viewModel.textToCopy = ko.observable(document.getElementById('myInput').value); // テキストの初期値を取得
ko.applyBindings(viewModel);