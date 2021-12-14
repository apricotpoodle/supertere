' Code effectué suite à modification de la fenêtre frmResultatScrutinLst
' Tout ce Code est repris en PHP dans ScrutController.php
' la méthode est au moment où ces lignes sont écrites :
Private Sub cmdOK_Click()
On Error GoTo RESU_ERR
Dim IsBallotage As Byte
'Contrôle présence du nombre de sièges
If Len(Trim(Me.txtSiege)) = 0 And Me.grdResult.Visible = True Then
   MsgBox "Le nombre de sièges doit être renseigné !", vbExclamation, "Attention"
   Me.txtSiege.SetFocus
   Exit Sub
   End If
'
If Not (SauvegardeResultatsScrutin()) Then Exit Sub

  If SelNumTour = "01" Then
    IsBallotage = DataEnvironment1.cmdCheckBallo1ce(SelElec, SelIndiCle, SelTypScru, selEntgCle)
  Else
    IsBallotage = 0
  End If

  ' possiblite d'enregistrer les conseils municipaux
  If Trim(SelTypElec) = "Municipale" And Me.grdResult.Rows > 1 And Me.grdResult.Visible = True _
     And IsBallotage = 0 Then
    If MsgBox("Voulez-vous enregister la composition des conseils ?", vbQuestion + vbYesNo) = vbYes Then
      Load frmConseilMunicipal
      selEgeoSieges = IIf(Trim(Me.txtSiege) = "", 0, Me.txtSiege)
      frmConseilMunicipal.Show vbModal
      Exit Sub
      End If
     Else
     Me.cmdConseil.Enabled = False
   End If

RESU_EXIT:
  Screen.MousePointer = vbDefault
  Exit Sub
RESU_ERR:
  GestionErreur
  Resume RESU_EXIT
End Sub