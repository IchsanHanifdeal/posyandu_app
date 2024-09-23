window.SCHEME = {
  "type": "text",
  "content": " ",
  "position": {
    "x": 27.5,
    "y": 45.90
  },
  "width": 120,
  "height": 4,
  "rotate": 0,
  "alignment": "left",
  "verticalAlignment": "top",
  "fontSize": 9.5,
  "lineHeight": 1,
  "characterSpacing": 0,
  "fontColor": "#2C2E35",
  //   "required": true,
  "fontName": "lucida",
  "backgroundColor": "#E7F4DF"
}

const _HIDE_PAGE = {
  ...SCHEME,
  "position": {
    "x": 69,
    "y": 221.55
  },
  "width": 15.27,
  height: 9.23,
  "required": false,
  "editable": false,
  "readOnly": true
}

window.AMANAT_PERSALINAN_IBU = () => {
  return {
    _HIDE_PAGE,
    "saya": {
      ...SCHEME,
      "position": {
        "x": 27.5,
        "y": 47.5
      },
      "width": 112,
    },
    "alamat": {
      ...SCHEME,
      "position": {
        "x": 27.5,
        "y": 53
      },
      "width": 112,
    },
    "bulan": {
      ...SCHEME,
      "position": {
        "x": 97.14,
        "y": 62.11
      },
      "width": 20,
      "alignment": "center",
    },
    "tahun": {
      ...SCHEME,
      "position": {
        "x": 129.5,
        "y": 62.11
      },
      "width": 10.5,
      "alignment": "center",
    },
    "penolong_persalinan_1": {
      ...SCHEME,
      "position": {
        "x": 64.5,
        "y": 72.9
      },
      "width": 75,
    },
    "penolong_persalinan_2": {
      ...SCHEME,
      "position": {
        "x": 64.5,
        "y": 78.3
      },
      "width": 75,
    },
    "dana_persalinan": {
      ...SCHEME,
      "position": {
        "x": 36,
        "y": 94.5
      },
      "width": 104,
    },
    "kendaraan_1": {
      ...SCHEME,
      "position": {
        "x": 45.5,
        "y": 105
      },
      "width": 52,
    },
    "kendaraan_2": {
      ...SCHEME,
      "position": {
        "x": 45.5,
        "y": 110.5
      },
      "width": 52,
    },
    "kendaraan_3": {
      ...SCHEME,
      "position": {
        "x": 45.5,
        "y": 115.5
      },
      "width": 52,
    },
    "kendaraan_1>hp": {
      ...SCHEME,
      "position": {
        "x": 108,
        "y": 104.95
      },
      "width": 34,
    },
    "kendaraan_2>hp": {
      ...SCHEME,
      "position": {
        "x": 108,
        "y": 110.45
      },
      "width": 34,
    },
    "kendaraan_3>hp": {
      ...SCHEME,
      "position": {
        "x": 108,
        "y": 115.45
      },
      "width": 34,
    },
    "metode_kontrasepsi": {
      ...SCHEME,
      "position": {
        "x": 36,
        "y": 128.03
      },
      "width": 105,
    },
    "golongan_darah_sumbangan": {
      ...SCHEME,
      "position": {
        "x": 105.79,
        "y": 132.5
      },
      "width": 9.43,
      "alignment": "center",
    },
    "rhesus_sumbangan": {
      ...SCHEME,
      "position": {
        "x": 127.79,
        "y": 132.5
      },
      "width": 9.9,
      "alignment": "center",
    },
    "sumbangan_darah_oleh_1": {
      ...SCHEME,
      "position": {
        "x": 45.7,
        "y": 141.99
      },
      "width": 51,
    },
    "sumbangan_darah_oleh_2": {
      ...SCHEME,
      "position": {
        "x": 45.7,
        "y": 146.5
      },
      "width": 51,
    },
    "sumbangan_darah_oleh_3": {
      ...SCHEME,
      "position": {
        "x": 45.7,
        "y": 150.49
      },
      "width": 51,
    },
    "sumbangan_darah_oleh_4": {
      ...SCHEME,
      "position": {
        "x": 45.7,
        "y": 154.41
      },
      "width": 51,
    },
    "sumbangan_darah_oleh_1>hp": {
      ...SCHEME,
      "position": {
        "x": 109.27,
        "y": 141.7
      },
      "width": 33,
    },
    "sumbangan_darah_oleh_2>hp": {
      ...SCHEME,
      "position": {
        "x": 109.27,
        "y": 146.2
      },
      "width": 33,
    },
    "sumbangan_darah_oleh_3>hp": {
      ...SCHEME,
      "position": {
        "x": 109.27,
        "y": 151
      },
      "width": 33,
    },
    "sumbangan_darah_oleh_4>hp": {
      ...SCHEME,
      "position": {
        "x": 109.27,
        "y": 155
      },
      "width": 33,
    },
    "nama_TTD_persetujuan": {
      ...SCHEME,
      "position": {
        "x": 23.95,
        "y": 194.57
      },
      "width": 35.5,
      alignment: "center",
    },
    "nama_TTD_ibu_hamil": {
      ...SCHEME,
      "position": {
        "x": 92.16,
        "y": 194.57
      },
      "width": 35.5,
      alignment: "center",
    },
    "nama_TTD_bidan_/_dokter": {
      ...SCHEME,
      "position": {
        "x": 58.5,
        "y": 216
      },
      "width": 35.5,
      alignment: "center",
    },
  }
}

window.PELAYANAN_DOKTER_EVALUASI = () => {
  SCHEME.fontSize = 8
  return {
    _HIDE_PAGE: {
      ..._HIDE_PAGE,
      position: {
        x: 72.97,
        y: 221.55
      }
    },
    "nama_dokter": {
      ...SCHEME,
      "position": {
        "x": 103.13,
        "y": 19.69
      },
      "width": 41.68,
    },
    "faskes": {
      ...SCHEME,
      "position": {
        "x": 103.13,
        "y": 25.46
      },
      "width": 41.68,
    },
    "tanggal_periksa": {
      ...SCHEME,
      "position": {
        "x": 39.19,
        "y": 52.33
      },
      "width": 38.71,
    },
    "TB_ibu": {
      ...SCHEME,
      "position": {
        "x": 25.55,
        "y": 58.24
      },
      "width": 7.21,
      "height": 4.26,
      "verticalAlignment": "middle",
      "alignment": "center",
      "backgroundColor": ""
    },
    "BB_ibu": {
      ...SCHEME,
      "position": {
        "x": 25.55,
        "y": 63
      },
      "width": 7.21,
      "height": 4.26,
      "verticalAlignment": "middle",
      "alignment": "center",
      "backgroundColor": ""
    },
    "LILA_ibu": {
      ...SCHEME,
      "position": {
        "x": 25.55,
        "y": 68
      },
      "width": 7.21,
      "height": 4.26,
      "verticalAlignment": "middle",
      "alignment": "center",
      "backgroundColor": ""
    },
    "status_imunisasi_1": {
      ...SCHEME,
      "position": {
        "x": 135.5,
        "y": 62
      },
      "width": 9.6,
      "height": 3.47,
      "verticalAlignment": "middle",
      "alignment": "center",
      "backgroundColor": ""
    },
    "status_imunisasi_2": {
      ...SCHEME,
      "position": {
        "x": 135.5,
        "y": 66
      },
      "width": 9.6,
      "height": 3.47,
      "verticalAlignment": "middle",
      "alignment": "center",
      "backgroundColor": ""
    },
    "status_imunisasi_3": {
      ...SCHEME,
      "position": {
        "x": 135.5,
        "y": 70
      },
      "width": 9.6,
      "height": 3.47,
      "verticalAlignment": "middle",
      "alignment": "center",
      "backgroundColor": ""
    },
    "status_imunisasi_4": {
      ...SCHEME,
      "position": {
        "x": 135.5,
        "y": 74
      },
      "width": 9.6,
      "height": 3.47,
      "verticalAlignment": "middle",
      "alignment": "center",
      "backgroundColor": ""
    },
    "status_imunisasi_5": {
      ...SCHEME,
      "position": {
        "x": 135.5,
        "y": 78
      },
      "width": 9.6,
      "height": 3.47,
      "verticalAlignment": "middle",
      "alignment": "center",
      "backgroundColor": ""
    },
    "riwayat_diabetes": {
      ...SCHEME,
      "position": {
        "x": 34.44,
        "y": 104
      },
      "width": 41.68,
      "backgroundColor": "#FFF6B2"
    },
    "riwayat_kesehatan_lainnya": {
      ...SCHEME,
      "position": {
        "x": 34.44,
        "y": 108.97
      },
      "width": 41.68,
      "backgroundColor": "#FFF6B2"
    },
    "riwayat_perilaku_lainnya": {
      ...SCHEME,
      "position": {
        "x": 81,
        "y": 115.98
      },
      "width": 63,
    },
    "riwayat_kp_nomor": {
      ...SCHEME,
      content: "123456",
      "position": {
        "x": 15.76,
        "y": 137.7
      },
      "width": 2.45,
      "height": 20.5,
      "verticalAlignment": "middle",
      "alignment": "center",
      "backgroundColor": "",
      "lineHeight": 1.36,
      "readOnly": true,
      "required": false
    },
    "riwayat_kp_tahun_1": {

      ...SCHEME,
      "position": {
        "x": 21.26,
        "y": 136.73
      },
      "width": 15.68,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_2": {

      ...SCHEME,
      "position": {
        "x": 21.26,
        "y": 139.91
      },
      "width": 15.68,
      height: 4.53,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_3": {

      ...SCHEME,
      "position": {
        "x": 21.26,
        "y": 145.3
      },
      "width": 15.68,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_4": {

      ...SCHEME,
      "position": {
        "x": 21.26,
        "y": 149
      },
      "width": 15.68,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_5": {

      ...SCHEME,
      "position": {
        "x": 21.26,
        "y": 152.6
      },
      "width": 15.68,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_6": {

      ...SCHEME,
      "position": {
        "x": 21.26,
        "y": 156.3
      },
      "width": 15.68,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_1>berat_lahir": {

      ...SCHEME,
      "position": {
        "x": 37.4,
        "y": 136.73
      },
      "width": 17.5,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_2>berat_lahir": {

      ...SCHEME,
      "position": {
        "x": 37.4,
        "y": 139.91
      },
      "width": 17.5,
      height: 4.53,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_3>berat_lahir": {

      ...SCHEME,
      "position": {
        "x": 37.4,
        "y": 145.3
      },
      "width": 17.5,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_4>berat_lahir": {

      ...SCHEME,
      "position": {
        "x": 37.4,
        "y": 149
      },
      "width": 17.5,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_5>berat_lahir": {

      ...SCHEME,
      "position": {
        "x": 37.4,
        "y": 152.6
      },
      "width": 17.5,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_6>berat_lahir": {

      ...SCHEME,
      "position": {
        "x": 37.4,
        "y": 156.3
      },
      "width": 17.5,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_1>berat_lahir>persalinan": {

      ...SCHEME,
      "position": {
        "x": 54.9,
        "y": 136.73
      },
      "width": 24.5,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_2>berat_lahir>persalinan": {

      ...SCHEME,
      "position": {
        "x": 54.9,
        "y": 139.91
      },
      "width": 24.5,
      height: 4.53,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_3>berat_lahir>persalinan": {

      ...SCHEME,
      "position": {
        "x": 54.9,
        "y": 145.3
      },
      "width": 24.5,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_4>berat_lahir>persalinan": {

      ...SCHEME,
      "position": {
        "x": 54.9,
        "y": 149
      },
      "width": 24.5,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_5>berat_lahir>persalinan": {

      ...SCHEME,
      "position": {
        "x": 54.9,
        "y": 152.6
      },
      "width": 24.5,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_6>berat_lahir>persalinan": {

      ...SCHEME,
      "position": {
        "x": 54.9,
        "y": 156.3
      },
      "width": 24.5,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_1>berat_lahir>persalinan>penolong": {

      ...SCHEME,
      "position": {
        "x": 80.24,
        "y": 136.73
      },
      "width": 32,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_2>berat_lahir>persalinan>penolong": {

      ...SCHEME,
      "position": {
        "x": 80.24,
        "y": 139.91
      },
      "width": 32,
      height: 4.53,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_3>berat_lahir>persalinan>penolong": {

      ...SCHEME,
      "position": {
        "x": 80.24,
        "y": 145.3
      },
      "width": 32,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_4>berat_lahir>persalinan>penolong": {

      ...SCHEME,
      "position": {
        "x": 80.24,
        "y": 149
      },
      "width": 32,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_5>berat_lahir>persalinan>penolong": {

      ...SCHEME,
      "position": {
        "x": 80.24,
        "y": 152.6
      },
      "width": 32,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_6>berat_lahir>persalinan>penolong": {

      ...SCHEME,
      "position": {
        "x": 80.24,
        "y": 156.3
      },
      "width": 32,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_1>berat_lahir>persalinan>penolong>komplikasi": {

      ...SCHEME,
      "position": {
        "x": 112.5,
        "y": 136.73
      },
      "width": 32.5,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_2>berat_lahir>persalinan>penolong>komplikasi": {

      ...SCHEME,
      "position": {
        "x": 112.5,
        "y": 139.91
      },
      "width": 32.5,
      height: 4.53,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_3>berat_lahir>persalinan>penolong>komplikasi": {

      ...SCHEME,
      "position": {
        "x": 112.5,
        "y": 145.3
      },
      "width": 32.5,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_4>berat_lahir>persalinan>penolong>komplikasi": {

      ...SCHEME,
      "position": {
        "x": 112.5,
        "y": 149
      },
      "width": 32.5,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_5>berat_lahir>persalinan>penolong>komplikasi": {

      ...SCHEME,
      "position": {
        "x": 112.5,
        "y": 152.6
      },
      "width": 32.5,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_kp_tahun_6>berat_lahir>persalinan>penolong>komplikasi": {

      ...SCHEME,
      "position": {
        "x": 112.5,
        "y": 156.3
      },
      "width": 32.5,
      height: 2.94,
      "alignment": "center",
      "verticalAlignment": "middle",
      "backgroundColor": "",
    },
    "riwayat_penyakit_lainnya": {
      ...SCHEME,
      "position": {
        "x": 82.3,
        "y": 171
      },
      "width": 63,
      height: 23.31
    },
  }
}
