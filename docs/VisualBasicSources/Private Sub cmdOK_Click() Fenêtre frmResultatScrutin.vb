Private Sub cmdOK_Click() ' Fenêtre frmResultatScrutin
On Error GoTo RESU_ERR

'Cas Sénat_SM : Contrôle nombre de sièges
If Me.picSiege.Visible = True And Val(Me.txtSiege) = 0 Then
    MsgBox "Attention, vous devez saisir le nombre de sièges à pourvoir !", vbExclamation, "Attention"
    Me.txtSiege.SetFocus
    Exit Sub
End If

If Not (SauvegardeResultatsScrutin()) Then Exit Sub

RESU_EXIT:
  Screen.MousePointer = vbDefault
  Exit Sub
RESU_ERR:
  GestionErreur
  Resume RESU_EXIT
End Sub
