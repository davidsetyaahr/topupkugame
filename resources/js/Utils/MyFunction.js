import { Inertia } from '@inertiajs/inertia'
// import moment from 'moment'
export function rupiahInput(angka) {
    if(angka!=0 && angka!=''){
        var number_string = angka.replace(/[^,\d]/g, "").toString();
        var split = number_string.split(",")
        var sisa = split[0].length % 3
        var rupiah = split[0].substr(0, sisa)
        var ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            var separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }
        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return rupiah;
    }
    else{
        return ''
    }
}
export function asset(assetName) {
    return window.location.origin+"/assets/"+assetName;
}
export function storage(assetName) {
    return window.location.origin+"/storage/"+assetName
}
export function formatRupiah(angka, prefix){
    angka = angka.toString()
	var number_string = angka.replace(/[^,\d]/g, '').toString(),
	split   		= number_string.split(','),
	sisa     		= split[0].length % 3,
	rupiah     		= split[0].substr(0, sisa),
	ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if(ribuan){
		var separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}
 
	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

// export function dateTime(date,withTime=false){
//     let formatDate = 'DD-MM-YYYY'
//     const format = withTime ? formatDate+' HH:mm' : formatDate 
//     if(date==null){
//         return '-'
//     }
//     else{
//         return moment(date).format(format);
//     }
// }
export function myModal(id,tipe){
    if(tipe=='show'){
    var myModal = new bootstrap.Modal(document.getElementById(id), {})
        myModal.show()
    }else{
        var myModalEl = document.getElementById(id);
        var modal = bootstrap.Modal.getInstance(myModalEl)
        modal.hide();
    }
}

